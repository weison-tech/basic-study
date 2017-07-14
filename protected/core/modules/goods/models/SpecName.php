<?php
namespace core\modules\goods\models;

use Yii;

/**
 * This is the model class for table "{{%spec_name}}".
 *
 * @property integer $id
 * @property string $type_id
 * @property string $name
 * @property string $order
 * @property integer $search_index
 * @property integer $status
 */
class SpecName extends \yii\db\ActiveRecord
{
    /**
     * @var string Temporary to store the value items before save to SpecValue table.
     */
    public $value_items;

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
        return '{{%spec_name}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'order', 'value_items', 'name'], 'required'],
            [['type_id', 'order', 'search_index', 'status'], 'integer'],
            [['name'], 'string', 'max' => 55],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('GoodsModule.models_SpecName', 'ID'),
            'type_id' => Yii::t('GoodsModule.models_SpecName', 'Type ID'),
            'name' => Yii::t('GoodsModule.models_SpecName', 'Name'),
            'order' => Yii::t('GoodsModule.models_SpecName', 'Order'),
            'search_index' => Yii::t('GoodsModule.models_SpecName', 'Search Index'),
            'status' => Yii::t('GoodsModule.models_SpecName', 'Status'),
            'value_items' => Yii::t('GoodsModule.models_SpecName', 'Value Items'),
        ];
    }

    /**
     * Initial the value
     */
    public function afterFind()
    {
        $values = SpecValue::find()->where(['spec_id' => $this->id])->asArray()->all();
        $values = array_column($values, 'value');
        $this->value_items = implode(PHP_EOL, $values);
        parent::afterFind();
    }

    /**
     * After save spec name, save spec values.
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        $items = array_filter(explode(PHP_EOL, $this->value_items));
        $items = array_map(function($v){ return trim($v); }, $items);

        //Find the current spec name's value, delete the value not contain in items
        $values = SpecValue::find()->where(['spec_id' => $this->id])->asArray()->all();
        if ($values) {
            $not_in_id = [];
            foreach ($values as $v) {
                if (!in_array($v['value'], $items)) {
                    $not_in_id[] = $v['id'];
                }
            }
            if (!empty($not_in_id)) {
                SpecValue::deleteAll(['in', 'id', $not_in_id]);
            }
        }

        //Add not contain value
        if ($items) {
            $values = array_column($values, 'value');
            foreach ($items as $k => $v) {
                if (in_array($v, $values)) {
                    unset($items[$k]);
                }
            }
            sort($items);
            foreach($items as $value) {
                $spec = new SpecValue();
                $spec->spec_id = $this->id;
                $spec->value = $value;
                $spec->save();
            }
        }

        parent::afterSave($insert, $changedAttributes);
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
     * The goods type relation.
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(GoodsType::className(), ['id' => 'type_id']);
    }
}
