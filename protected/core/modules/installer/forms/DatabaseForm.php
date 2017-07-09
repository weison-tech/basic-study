<?php
namespace core\modules\installer\forms;

use Yii;

/**
 * DatabaseForm holds all required database settings.
 */
class DatabaseForm extends \yii\base\Model
{

    /**
     * @var string hostname
     */
    public $hostname;

    /**
     * @var string username
     */
    public $username;

    /**
     * @var string password
     */
    public $password;

    /**
     * @var string database name
     */
    public $database;

    /**
     * @var string table prefix
     */
    public $tablePrefix;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array(
            array(['hostname', 'username', 'database', 'tablePrefix'], 'required'),
            array('password', 'safe'),
        );
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array(
            'hostname' => Yii::t('InstallerModule.forms_DatabaseForm', 'Hostname'),
            'username' => Yii::t('InstallerModule.forms_DatabaseForm', 'Username'),
            'password' => Yii::t('InstallerModule.forms_DatabaseForm', 'Password'),
            'database' => Yii::t('InstallerModule.forms_DatabaseForm', 'Name of Database'),
            'tablePrefix' => Yii::t('InstallerModule.forms_DatabaseForm', 'Table Prefix'),
        );
    }

}
