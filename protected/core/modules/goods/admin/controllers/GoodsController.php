<?php
namespace core\modules\goods\admin\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use core\modules\file\models\File;
use core\modules\goods\models\GoodsAttribute;
use core\modules\goods\models\GoodsAttributeRelation;
use core\modules\goods\models\GoodsSpec;
use core\modules\goods\models\SpecImage;
use core\modules\goods\models\SpecName;
use core\modules\goods\models\SpecValue;
use core\modules\goods\models\Goods;
use core\modules\goods\models\search\GoodsSearch;
use core\modules\admin\components\Controller;
use yii2mod\editable\EditableAction;

/**
 * GoodsController implements the CRUD actions for Goods model.
 */
class GoodsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'user' => 'admin',
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'ue-upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
                'config' => [
                    "imageUrlPrefix"  => Url::to('/', true),
                    "imagePathFormat" => "/uploads/ueditor/{yyyy}{mm}{dd}/{time}{rand:6}",
                    "imageRoot" => Yii::getAlias("@webroot"),
                ],
            ],
            'change-stock' => [
                'class' => EditableAction::className(),
                'modelClass' => Goods::className(),
                'forceCreate' => false
            ],
            'change-sort' => [
                'class' => EditableAction::className(),
                'modelClass' => Goods::className(),
                'forceCreate' => false
            ],
        ];
    }

    /**
     * Lists all Goods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Goods model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Goods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Goods();

        $params = Yii::$app->request->post();
        if ($model->load($params) && $model->save()) {
            foreach ($params as $k => $v) {
                //Add attributes
                if (strpos($k, 'attr') === 0) {
                    $attr_id = explode("_", $k)[1];
                    $old = GoodsAttributeRelation::find()
                        ->where(['goods_id' => $model->id, 'attr_id' => $attr_id])
                        ->one();
                    if ($old) {
                        $old->attr_value = is_array($v) ? implode(PHP_EOL, $v) : $v;
                        $old->save();
                    } else {
                        $gar = new GoodsAttributeRelation();
                        $gar->goods_id = $model->id;
                        $gar->attr_id = $attr_id;
                        $gar->attr_value = is_array($v) ? implode(PHP_EOL, $v) : $v;
                        $gar->save();
                    }
                }
            }

            //Handle spec value image.
            if (isset($params['fileUploaderHiddenGuidField'])) {
                $specs = $params['fileUploaderHiddenGuidField'];
                $this->handleSpecValueImage($specs, $model->id);
            }

            //Save goods specification item.
            if (isset($params['item'])) {
                $this->handleSpecItem($params['item'], $model->id);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Goods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $params = Yii::$app->request->post();

        if ($model->load($params) && $model->save()) {
            $attr_id_arr = [];
            foreach ($params as $k => $v) {
                //Add attributes
                if (strpos($k, 'attr') === 0) {
                    $attr_id = explode("_", $k)[1];
                    $old = GoodsAttributeRelation::find()
                        ->where(['goods_id' => $model->id, 'attr_id' => $attr_id])
                        ->one();
                    if ($old) {
                        $old->attr_value = is_array($v) ? implode(PHP_EOL, $v) : $v;
                        $old->save();
                    } else {
                        $gar = new GoodsAttributeRelation();
                        $gar->goods_id = $model->id;
                        $gar->attr_id = $attr_id;
                        $gar->attr_value = is_array($v) ? implode(PHP_EOL, $v) : $v;
                        $gar->save();
                    }
                    $attr_id_arr[] = $attr_id;
                }
            }

            //Delete unused attr
            GoodsAttributeRelation::deleteAll([
                    'and',
                    'goods_id = :goods_id',
                    ['not in', 'attr_id', $attr_id_arr]
                ], [
                    ':goods_id' => $model->id
                ]
            );

            //Handle spec value image.
            if (isset($params['fileUploaderHiddenGuidField'])) {
                $specs = $params['fileUploaderHiddenGuidField'];
                $this->handleSpecValueImage($specs, $model->id);
            }

            //Save goods specification item.
            if (isset($params['item'])) {
                $this->handleSpecItem($params['item'], $model->id);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @param array $items
     * @param integer $goods_id
     */
    public function handleSpecItem($items, $goods_id)
    {
        //Delete all old
        GoodsSpec::deleteAll(['goods_id' => $goods_id]);

        foreach($items as $k => $v)
        {
            $spec = new GoodsSpec();
            $spec->goods_id = $goods_id;
            $spec->key = $k;
            $spec->key_name = $v['key_name'];
            $spec->price = trim($v['price']);
            $spec->stock = trim($v['stock']);
            $spec->status = GoodsSpec::STATUS_ENABLED;
            $spec->save();
        }
    }

    /**
     * Handle spec value image for goods.
     * @param $specs
     * @param $goods_id
     */
    public function handleSpecValueImage($specs, $goods_id)
    {
        foreach ($specs as $k => $v) {
            if ($v) {
                $tmp = explode('_', $k);
                $spec_value_id = $tmp[count($tmp) - 1];
                $old = SpecImage::find()
                    ->where(['goods_id' => $goods_id, 'spec_value_id' => $spec_value_id])
                    ->one();
                $object = null;
                if (!$old) {
                    $si = new SpecImage();
                    $si->goods_id = $goods_id;
                    $si->spec_value_id = $spec_value_id;
                    if ($si->save(false)) {
                        $object = $si;
                    }
                } else {
                    $object = $old;
                }

                if ($object) {
                    //Attach image.
                    File::attachPrecreated($object, $v);
                }
            }
        }
    }

    /**
     * Deletes an existing Goods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Ajax action to select goods's attributes
     * @return string
     */
    public function actionSelectAttribute()
    {
        $params = Yii::$app->request->post();
        $goods_type = $params['goods_type'];
        $goods_id = $params['goods_id'];

        //Select all attribute
        $attributes = GoodsAttribute::find()
            ->where(array('type_id' => $goods_type, 'status' => GoodsAttribute::STATUS_ENABLED))
            ->orderBy('order asc')
            ->all();
        //Change attribute string to array
        foreach ($attributes as $k => $v) {
            $attributes[$k]['attr_values'] = explode(PHP_EOL, $v['attr_values']);
        }

        $values = [];
        if ($goods_id) {
            //Find the exist attribute value for the specify goods.
            $gar = GoodsAttributeRelation::find()
                ->where(['goods_id' => $goods_id])
                ->all();
            foreach ($gar as $vg) {
                $multiple = explode(PHP_EOL, $vg['attr_value']);
                $values[$vg['attr_id']] = count($multiple) > 1 ? $multiple : $vg['attr_value'];
            }
        }
        return $this->renderAjax('select-attribute', [ 'attributes' => $attributes, 'values' => $values ]);
    }

    /**
     * Ajax action to select goods's specification
     * @return string
     */
    public function actionSelectSpecification()
    {
        $params = Yii::$app->request->post();
        $goods_type = $params['goods_type'];
        $goods_id = $params['goods_id'];

        //Find all specification name.
        $spec_list = SpecName::find()
            ->where(['type_id' => $goods_type])
            ->orderBy('order asc')
            ->asArray()
            ->all();
        $spec_id_arr = array_column($spec_list, 'id');

        //Find all specification value.
        $spec_value_list = SpecValue::find()->where(['in', 'spec_id', $spec_id_arr])->all();
        foreach ($spec_list as $k => $v) {
            foreach ($spec_value_list as $v1) {
                if ($v1['spec_id'] == $v['id']) {
                    $spec_list[$k]['spec_item'][$v1['id']] = $v1['value'];
                }
            }
        }

        $spec_image_list = $items_ids = [];
        if ($goods_id) {
            //Find exist goods specification.
            $exist_goods_spec = GoodsSpec::find()
                ->where(['goods_id' => $goods_id])
                ->select("key")
                ->asArray()
                ->all();
            if ($exist_goods_spec) {
                $exist_spec_ids = '';
                foreach (array_column($exist_goods_spec, 'key') as $v) {
                    $exist_spec_ids .= $exist_spec_ids ? "," . $v : $v;
                }

                $items_ids = explode(',', $exist_spec_ids);

                $items_ids = array_unique($items_ids);
            }

            $spec_image_list = SpecImage::find()->where(['goods_id' => $goods_id])->all();
        }

        return $this->renderAjax('select-specification',
            compact('spec_list', 'items_ids', 'spec_image_list', 'goods_id')
        );
    }

    /**
     * Ajax get goods's specification item.
     */
    public function actionAjaxGetSpec(){
        $goods_id = Yii::$app->request->post('goods_id', 0);
        $spec_arr = Yii::$app->request->post('spec_arr', [[]]);
        $str = Goods::getSpecInput($goods_id, $spec_arr);
        exit($str);
    }

    /**
     * For ajax request to change value.
     */
    public function actionChangeValue()
    {
        $id = Yii::$app->request->post('id', 0);
        $field = Yii::$app->request->post('field', '');
        if ($id && $field) {
            $model = $this->findModel($id);
            $model->$field = (int)!$model->$field;
            $now = time();
            if ($field == 'is_on_sale' && $model->$field == 1 && !$model->on_sale_at) {
                $model->on_sale_at = $now;
            }
            if ($model->save()) {
                $data = ['code' => 200, 'msg' => Yii::t('GoodsModule.base', 'Change successfully.')];
                exit(json_encode($data));
            }
        } else {
            $data = ['code' => 500, 'msg' => Yii::t('GoodsModule.base', 'Parameters less.')];
            exit(json_encode($data));
        }
    }

    /**
     * Delete all specification images.
     */
    public function actionDeleteSpecImg()
    {
        $goods_id= Yii::$app->request->post('goods_id');
        //Find all spec image relation recorder.
        $spec_img = SpecImage::find()->where(['goods_id' => $goods_id])->asArray()->all();
        $spec_img_ids = array_column($spec_img, 'id');

        //Delete all spec image relation recorder.
        SpecImage::deleteAll(['in', 'id', $spec_img_ids]);

        //Delete all file.
        $files = File::find()->where(['object_model' => 'core\modules\goods\models\SpecImage'])
            ->andWhere(['in', 'object_id', $spec_img_ids])
            ->all();
        foreach($files as $file) {
            $file->delete();
        }
    }
}
