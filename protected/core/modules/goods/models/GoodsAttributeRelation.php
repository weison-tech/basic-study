<?php
namespace core\modules\goods\models;

use Yii;

/**
 * This is the model class for table "ys_goods_attribute_relation".
 *
 * @property integer $id
 * @property string $goods_id
 * @property string $attr_id
 * @property string $attr_value
 */
class GoodsAttributeRelation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ys_goods_attribute_relation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'attr_id', 'attr_value'], 'required'],
            [['goods_id', 'attr_id'], 'integer'],
            [['attr_value'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('GoodsModule.models_GoodsAttributeRelation', 'ID'),
            'goods_id' => Yii::t('GoodsModule.models_GoodsAttributeRelation', 'Goods ID'),
            'attr_id' => Yii::t('GoodsModule.models_GoodsAttributeRelation', 'Attr ID'),
            'attr_value' => Yii::t('GoodsModule.models_GoodsAttributeRelation', 'Attr Value'),
        ];
    }
}
