<?php
namespace core\modules\installer\forms;

use Yii;

/**
 * ConfigBasicForm holds basic application settings.
 */
class ConfigBasicForm extends \yii\base\Model
{

    /**
     * @var string name of installation
     */
    public $name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array(
            array('name', 'required'),
        );
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array(
            'name' => Yii::t('InstallerModule.forms_ConfigBasicForm', 'Name of your shopping platform'),
        );
    }

}
