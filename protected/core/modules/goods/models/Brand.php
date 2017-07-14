<?php
namespace core\modules\goods\models;

use Yii;
use core\modules\file\behaviors\UploadBehavior;
use core\modules\file\models\File;

/**
 * This is the model class for table "{{%brand}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $logo
 * @property string $description
 * @property string $url
 * @property string $sort
 * @property string $category_id
 * @property integer $status
 */
class Brand extends \yii\db\ActiveRecord
{
    public $logo;

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
        return '{{%brand}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'url', 'sort', 'category_id'], 'required'],
            [['description'], 'string'],
            [['sort', 'category_id', 'status'], 'integer'],
            [['name'], 'string', 'max' => 60],
            [['url'], 'string', 'max' => 255],
            [['logo'], 'safe']
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
                'attribute' => 'logo',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('GoodsModule.models_Brand', 'ID'),
            'name' => Yii::t('GoodsModule.models_Brand', 'Name'),
            'logo' => Yii::t('GoodsModule.models_Brand', 'Logo'),
            'description' => Yii::t('GoodsModule.models_Brand', 'Description'),
            'url' => Yii::t('GoodsModule.models_Brand', 'Url'),
            'sort' => Yii::t('GoodsModule.models_Brand', 'Sort'),
            'category_id' => Yii::t('GoodsModule.models_Brand', 'Cat ID'),
            'status' => Yii::t('GoodsModule.models_Brand', 'Display Status'),
        ];
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
     * The category relation.
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(GoodsCategory::className(), ['id' => 'category_id']);
    }

    /**
     * Relations to logo image
     * @return \yii\db\ActiveQuery
     */
    public function getLogoImg()
    {
        return $this->hasOne(File::className(), ['object_id' => 'id'])
            ->onCondition(['object_model' => self::className(), 'object_field' => 'logo']);
    }
}
