<?php
namespace core\modules\goods\models;

use Yii;

/**
 * This is the model class for table "{{%spec_value}}".
 *
 * @property integer $id
 * @property string $spec_id
 * @property string $value
 */
class SpecValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%spec_value}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['spec_id', 'value'], 'required'],
            [['spec_id'], 'integer'],
            [['value'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('GoodsModule.models_SpecValue', 'ID'),
            'spec_id' => Yii::t('GoodsModule.models_SpecValue', 'Spec ID'),
            'value' => Yii::t('GoodsModule.models_SpecValue', 'Value'),
        ];
    }
}
