<?php
namespace core\modules\goods\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%spec_image}}".
 *
 * @property string $goods_id
 * @property integer $spec_value_id
 * @property string $image_url
 * @property integer $status
 */
class SpecImage extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%spec_image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'spec_value_id', 'status'], 'integer'],
            [['image_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'goods_id' => Yii::t('GoodsModule.models_SpecImage', 'Goods ID'),
            'spec_value_id' => Yii::t('GoodsModule.models_SpecImage', 'Spec Value ID'),
            'image_url' => Yii::t('GoodsModule.models_SpecImage', 'Image Url'),
            'status' => Yii::t('GoodsModule.models_SpecImage', 'Status'),
        ];
    }
}
