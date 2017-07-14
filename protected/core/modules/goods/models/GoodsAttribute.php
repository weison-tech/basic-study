<?php
namespace core\modules\goods\models;

use Yii;

/**
 * This is the model class for table "{{%goods_attribute}}".
 *
 * @property integer $id
 * @property string $attr_name
 * @property string $type_id
 * @property integer $attr_index
 * @property integer $attr_type
 * @property integer $attr_input_type
 * @property string $attr_values
 * @property integer $order
 * @property integer $status
 */
class GoodsAttribute extends \yii\db\ActiveRecord
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
     * Single line text input
     */
    const INPUT_TYPE_TEXT = 1;

    /**
     * Multiple line text input
     */
    const INPUT_TYPE_TEXT_AREA = 2;

    /**
     * Select input , may be select radio checkbox.
     */
    const INPUT_TYPE_SELECT_LIST = 3;

    /**
     * Single value attribute
     */
    const ATTR_TYPE_SINGLE = 1;

    /**
     * Multiple values attribute
     */
    const ATTR_TYPE_MULTIPLE = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_attribute}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attr_name', 'type_id', 'attr_input_type', 'order'], 'required'],
            [['type_id', 'attr_index', 'attr_type', 'attr_input_type', 'order', 'status'], 'integer'],
            [['attr_values'], 'string'],
            [['attr_name'], 'string', 'max' => 60],
            ['attr_input_type', 'validateInputType', 'skipOnError' => false, 'skipOnEmpty'=>false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function validateInputType($attribute, $params)
    {
        if ($this->$attribute == $this::INPUT_TYPE_SELECT_LIST) {
            if (!$this->attr_values) {
                $this->addError('attr_values', Yii::t('GoodsModule.models_GoodsAttribute', 'Select values can not be blank.'));
                return false;
            }
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('GoodsModule.models_GoodsAttribute', 'ID'),
            'attr_name' => Yii::t('GoodsModule.models_GoodsAttribute', 'Attr Name'),
            'type_id' => Yii::t('GoodsModule.models_GoodsAttribute', 'Type ID'),
            'attr_index' => Yii::t('GoodsModule.models_GoodsAttribute', 'Attr Index'),
            'attr_type' => Yii::t('GoodsModule.models_GoodsAttribute', 'Attr Type'),
            'attr_input_type' => Yii::t('GoodsModule.models_GoodsAttribute', 'Attr Input Type'),
            'attr_values' => Yii::t('GoodsModule.models_GoodsAttribute', 'Attr Values'),
            'order' => Yii::t('GoodsModule.models_GoodsAttribute', 'Order'),
            'status' => Yii::t('GoodsModule.models_GoodsAttribute', 'Status'),
        ];
    }

    /**
     * Get the input type description or input type array.
     * @param bool|int $type
     * @return array|mixed
     */
    public static function getInputType($type = false)
    {
        $data = [
            self::INPUT_TYPE_TEXT => Yii::t('GoodsModule.models_GoodsAttribute', 'Text input'),
            self::INPUT_TYPE_TEXT_AREA => Yii::t('GoodsModule.models_GoodsAttribute', 'Text area input'),
            self::INPUT_TYPE_SELECT_LIST => Yii::t('GoodsModule.models_GoodsAttribute', 'Select list'),
        ];
        return $type === false ? $data : $data[$type];
    }

    /**
     * Get the attribute type description or attribute type array.
     * @param bool|int $type
     * @return array|mixed
     */
    public static function getAttributeType($type = false)
    {
        $data = [
            self::ATTR_TYPE_SINGLE => Yii::t('GoodsModule.models_GoodsAttribute', 'Single attribute'),
            self::ATTR_TYPE_MULTIPLE => Yii::t('GoodsModule.models_GoodsAttribute', 'Multiple attribute'),
        ];
        return $type === false ? $data : $data[$type];
    }

    /**
     * The goods type relation.
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(GoodsType::className(), ['id' => 'type_id']);
    }
}
