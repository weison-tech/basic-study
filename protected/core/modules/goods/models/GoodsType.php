<?php
namespace core\modules\goods\models;

use Yii;

/**
 * This is the model class for table "{{%goods_type}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 */
class GoodsType extends \yii\db\ActiveRecord
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
        return '{{%goods_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('GoodsModule.models_GoodsType', 'ID'),
            'name' => Yii::t('GoodsModule.models_GoodsType', 'Name'),
            'status' => Yii::t('GoodsModule.models_GoodsType', 'Status'),
        ];
    }

    /**
     * Change the null value to be corresponding default value.
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($this->status == null) {
            $this->status = 1;
        }
        return parent::beforeSave($insert);
    }
}
