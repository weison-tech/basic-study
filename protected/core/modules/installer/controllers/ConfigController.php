<?php
namespace core\modules\installer\controllers;

use Yii;
use core\components\Controller;
use core\modules\admin\forms\AdminForm;
use core\modules\admin\models\Admin;

/**
 * ConfigController allows inital configuration of shop.
 * E.g. Name of Network, Root User
 *
 * ConfigController can only run after SetupController wrote the initial
 * configuration.
 */
class ConfigController extends Controller
{

    const EVENT_INSTALL_SAMPLE_DATA = 'install_sample_data';

    /**
     * Before each config controller action check if
     *  - Database Connection works
     *  - Database Migrated Up
     *  - Not already configured (e.g. update)
     *
     * @param boolean
     */
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {

            // Flush Caches
            Yii::$app->cache->flush();

            // Database Connection seems not to work
            if (!$this->module->checkDBConnection()) {
                $this->redirect(['/installer/setup']);
                return false;
            }

            // When not at index action, verify that database is not already configured
            if ($action->id != 'finished') {
                if ($this->module->isConfigured()) {
                    $this->redirect(['finished']);
                    return false;
                }
            }

            return true;
        }
        return false;
    }

    /**
     * Index is only called on fresh databases, when there are already settings
     * in database, the user will directly redirected to actionFinished()
     */
    public function actionIndex()
    {
        if (Yii::$app->settings->get('name') == "") {
            Yii::$app->settings->set('name', "Yii Shop");
        }

        //Init some default data.
        \core\modules\installer\libs\InitialData::bootstrap();

        return $this->redirect($this->module->getNextConfigStepUrl());
    }

    /**
     * Basic Settings Form
     */
    public function actionBasic()
    {
        $form = new \core\modules\installer\forms\ConfigBasicForm();
        $form->name = Yii::$app->settings->get('name');

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            Yii::$app->settings->set('name', $form->name);
            return $this->redirect($this->module->getNextConfigStepUrl());
        }

        return $this->render('basic', array('model' => $form));
    }

    /**
     * Setup Administrative User
     *
     * This should be the last step, before the user is created also the
     * application secret will created.
     */
    public function actionAdmin()
    {

        // Admin account already created
        if (Admin::find()->count() > 0) {
            return $this->redirect($this->module->getNextConfigStepUrl());
        }

        $adminModel = new AdminForm();

        if ($adminModel->load(Yii::$app->request->post()) && $adminModel->validate() && $adminModel->create()) {
            return $this->redirect(Yii::$app->getModule('installer')->getNextConfigStepUrl());
        }

        return $this->render('admin', array('model' => $adminModel));
    }

    public function actionFinish()
    {
        if (Yii::$app->settings->get('secret') == "") {
            Yii::$app->settings->set('secret', \core\libs\UUID::v4());
        }

        \core\libs\DynamicConfig::rewrite();

        return $this->redirect(['finished']);
    }

    /**
     * Last Step, finish up the installation
     */
    public function actionFinished()
    {
        // Should not happen
        if (Yii::$app->settings->get('secret') == "") {
            throw new CException("Finished without secret setting!");
        }

        Yii::$app->settings->set('timeZone', Yii::$app->timeZone);

        // Set to installed
        $this->module->setInstalled();

        try {
            Yii::$app->user->logout();
        } catch (Exception $e) {
            ;
        }
        return $this->render('finished');
    }

}
