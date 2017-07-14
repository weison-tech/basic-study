<?php
namespace core\modules\goods\models;

use Yii;

/**
 * This is the model class for table "{{%goods_spec}}".
 *
 * @property string $goods_id
 * @property string $key
 * @property string $key_name
 * @property string $price
 * @property string $stock
 * @property integer $status
 */
class GoodsSpec extends \yii\db\ActiveRecord
{
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
        return '{{%goods_spec}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'stock', 'status'], 'integer'],
            [['price'], 'number'],
            [['key', 'key_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'goods_id' => Yii::t('GoodsModule.models_GoodsSpec', 'Goods ID'),
            'key' => Yii::t('GoodsModule.models_GoodsSpec', 'Key'),
            'key_name' => Yii::t('GoodsModule.models_GoodsSpec', 'Key Name'),
            'price' => Yii::t('GoodsModule.models_GoodsSpec', 'Price'),
            'stock' => Yii::t('GoodsModule.models_GoodsSpec', 'Stock'),
            'status' => Yii::t('GoodsModule.models_GoodsSpec', 'Status'),
        ];
    }
}
