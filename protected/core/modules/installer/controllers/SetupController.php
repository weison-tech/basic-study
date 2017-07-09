<?php
namespace core\modules\installer\controllers;

use Yii;
use core\components\Controller;
use core\modules\installer\forms\DatabaseForm;
use core\libs\DynamicConfig;
use core\modules\installer\widgets\PrerequisitesList;
use core\commands\MigrateController;

/**
 * SetupController checks prerequisites and is responsible for database
 * connection and schema setup.
 */
class SetupController extends Controller
{

    const PASSWORD_PLACEHOLDER = 'nothingToSeeHere!';

    public function actionIndex()
    {
        return $this->redirect(['prerequisites']);
    }

    /**
     * Prequisites action checks application requirement using the SelfTest
     * Libary
     *
     * (Step 2)
     */
    public function actionPrerequisites()
    {
        return $this->render('prerequisites', ['hasError' => PrerequisitesList::hasError()]);
    }

    /**
     * Database action is responsible for all database related stuff.
     * Checking given database settings, writing them into a config file.
     *
     * (Step 3)
     */
    public function actionDatabase()
    {
        $errorMessage = "";

        //Load config params from dynamic config file.
        $config = DynamicConfig::load();

        //Init DatabaseForm model with dynamic config params.
        $model = new DatabaseForm();
        if (isset($config['params']['installer']['db']['installer_hostname'])) {
            $model->hostname = $config['params']['installer']['db']['installer_hostname'];
        }

        if (isset($config['params']['installer']['db']['installer_database'])) {
            $model->database = $config['params']['installer']['db']['installer_database'];
        }

        if (isset($config['components']['db']['username'])) {
            $model->username = $config['components']['db']['username'];
        }

        if (isset($config['components']['db']['password'])) {
            $model->password = self::PASSWORD_PLACEHOLDER;
        }

        if (isset($config['components']['db']['tablePrefix'])) {
            $model->tablePrefix = $config['components']['db']['tablePrefix'];
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $connectionString = "mysql:host=" . $model->hostname . ";dbname=" . $model->database;

            $password = $model->password;
            if ($password == self::PASSWORD_PLACEHOLDER) {
                $password = $config['components']['db']['password'];
            }

            // Create Test DB Connection
            $dbConfig = [
                'class' => 'yii\db\Connection',
                'dsn' => $connectionString,
                'username' => $model->username,
                'password' => $password,
                'tablePrefix' => $model->tablePrefix,
                'charset' => 'utf8',
            ];


            Yii::$app->set('db', $dbConfig);

            try {
                // Check DB Connection
                Yii::$app->db->open();

                // Write Config
                $config['components']['db'] = $dbConfig;
                $config['params']['installer']['db']['installer_hostname'] = $model->hostname;
                $config['params']['installer']['db']['installer_database'] = $model->database;

                DynamicConfig::save($config);

                return $this->redirect(['init']);
            } catch (\Exception $e) {
                $errorMessage = $e->getMessage();
            }
        }

        // Render Template
        return $this->render('database', array('model' => $model, 'errorMessage' => $errorMessage));
    }

    /**
     * The init action imports the database structure & inital data
     */
    public function actionInit()
    {

        if (!$this->module->checkDBConnection()) {
            return $this->redirect(['database']);
        }

        // Flush Caches
        Yii::$app->cache->flush();

        // Disable max execution time to avoid timeouts during database installation
        @ini_set('max_execution_time', 0);

        // Migrate Up Database
        MigrateController::webMigrateAll();

        //Rewrites DynamicConfiguration based on Database Stored Settings
        DynamicConfig::rewrite();

        //Set the DynamicConfiguration's param databaseInstalled to be true.
        $this->module->setDatabaseInstalled();

        return $this->redirect(['/installer/config/index']);
    }

}
