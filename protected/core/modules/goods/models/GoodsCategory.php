<?php
namespace core\modules\goods\models;

use Yii;
use core\modules\file\behaviors\UploadBehavior;
use core\modules\file\models\File;

/**
 * This is the model class for table "{{%goods_category}}".
 *
 * @property string $id
 * @property string $name
 * @property string $short_name
 * @property string $parent_id
 * @property integer $sort_order
 * @property string $image
 * @property integer $status
 */
class GoodsCategory extends \yii\db\ActiveRecord
{
    public $image;

    /**
     * Status disabled.
     */
    const STATUS_DISABLED = 0;

    /**
     * Status enabled.
     */
    const STATUS_ENABLED = 1;

    /**
     * Status deleted.
     */
    const STATUS_DELETED = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'short_name', 'sort_order'], 'required'],
            [['id', 'parent_id', 'sort_order', 'status'], 'integer'],
            [['name'], 'string', 'max' => 90],
            [['short_name'], 'string', 'max' => 60],
            [['image'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'image',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('GoodsModule.models_GoodsCategory', 'ID'),
            'name' => Yii::t('GoodsModule.models_GoodsCategory', 'Name'),
            'short_name' => Yii::t('GoodsModule.models_GoodsCategory', 'Short Name'),
            'parent_id' => Yii::t('GoodsModule.models_GoodsCategory', 'Parent ID'),
            'sort_order' => Yii::t('GoodsModule.models_GoodsCategory', 'Sort Order'),
            'image' => Yii::t('GoodsModule.models_GoodsCategory', 'Image'),
            'status' => Yii::t('GoodsModule.models_GoodsCategory', 'Display Status'),
        ];
    }

    /**
     * The parent relation.
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'parent_id']);
    }

    /**
     * Change the null value to be corresponding default value.
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($this->parent_id == null) {
            $this->parent_id = 0;
        }
        return parent::beforeSave($insert);
    }

    /**
     * Get the status description or status array.
     * @param bool|int $status
     * @return array|mixed
     */
    public static function getStatus($status = false)
    {
        $data = [
            self::STATUS_ENABLED => Yii::t('GoodsModule.models_GoodsCategory', 'Enabled'),
            self::STATUS_DISABLED => Yii::t('GoodsModule.models_GoodsCategory', 'Disabled'),
        ];
        return $status === false ? $data : $data[$status];
    }

    /**
     * Get all catalog order by parent/child with the space before child label
     * Usage: ArrayHelper::map(GoodsCatalog::get(0, GoodsCatalog::find()->asArray()->all()), 'id', 'label')
     * @param int $parentId parent catalog id
     * @param array $array catalog array list
     * @param int $level catalog level, will affect $repeat
     * @param int $add times of $repeat
     * @param string $repeat symbols or spaces to be added for sub catalog
     * @return array  catalog collections
     */
    static public function get($parentId = 0, $array = [], $level = 0, $add = 2, $repeat = '　')
    {
        $strRepeat = '';
        // add some spaces or symbols for non top level categories
        if ($level > 1) {
            for ($j = 0; $j < $level; $j++) {
                $strRepeat .= $repeat;
            }
        }
        $newArray = array();
        //performance is not very good here
        foreach ((array)$array as $v) {
            if ($v['parent_id'] == $parentId) {
                $item = (array)$v;
                $item['label'] = $strRepeat . (isset($v['title']) ? $v['title'] : $v['name']);
                $newArray[] = $item;
                $tempArray = self::get($v['id'], $array, ($level + $add), $add, $repeat);
                if ($tempArray) {
                    $newArray = array_merge($newArray, $tempArray);
                }
            }
        }
        return $newArray;
    }

    /**
     * Relation to image.
     * @return \yii\db\ActiveQuery
     */
    public function getImg()
    {
        return $this->hasOne(File::className(), ['object_id' => 'id'])
            ->onCondition(['object_model' => self::className(), 'object_field' => 'image']);
    }
}
