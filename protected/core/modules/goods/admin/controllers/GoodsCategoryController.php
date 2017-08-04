<?php
namespace core\modules\goods\admin\controllers;

use Yii;
use core\modules\goods\models\GoodsCategory;
use core\modules\goods\models\search\GoodsCategorySearch;
use core\modules\admin\components\Controller;
use yii\web\NotFoundHttpException;
use yii2mod\editable\EditableAction;

/**
 * GoodsCategoryController implements the CRUD actions for GoodsCategory model.
 */
class GoodsCategoryController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'change-sort' => [
                'class' => EditableAction::className(),
                'modelClass' => GoodsCategory::className(),
                'forceCreate' => false
            ],
        ];
    }

    /**
     * Lists all GoodsCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoodsCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GoodsCategory model.
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
     * Creates a new GoodsCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GoodsCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing GoodsCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing GoodsCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        //Delete current category.
        $model->status = $model::STATUS_DELETED;
        $model->save();
        //Delete children.
        $model::updateAll(['status' => $model::STATUS_DELETED], ['parent_id' => $model->id]);

        return $this->redirect(['index']);
    }

    /**
     * Finds the GoodsCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GoodsCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GoodsCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * For ajax request to change status.
     */
    public function actionChangeStatus()
    {
        $params = Yii::$app->request->post();
        if (isset($params['id'])) {
            $model = $this->findModel($params['id']);
            $model->status = (int)!$model->status;
            if ($model->save()) {
                $data = ['code' => 200, 'msg' => Yii::t('GoodsModule.base', 'Change successfully.')];
                exit(json_encode($data));
            }
        } else {
            $data = ['code' => 500, 'msg' => Yii::t('GoodsModule.base', 'Parameters less.')];
            exit(json_encode($data));
        }
    }
}
