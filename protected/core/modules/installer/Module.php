<?php
namespace core\modules\installer;

use Yii;
use yii\helpers\Url;
use yii\base\Exception;
use yii\web\HttpException;
use core\libs\DynamicConfig;

/**
 * InstallerModule provides an web installation interface for the applcation
 */
class Module extends \core\components\Module
{

    /**
     * @event on configuration steps init
     */
    const EVENT_INIT_CONFIG_STEPS = 'steps';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'core\modules\installer\controllers';

    public $defaultRoute = 'index';

    /**
     * Array of config steps
     *
     * @var array
     */
    public $configSteps = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->layout = '@core/modules/installer/views/layouts/main.php';
        $this->initConfigSteps();
        $this->sortConfigSteps();
    }

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {

        // Block installer, when it's marked as installed
        if (Yii::$app->params['installed']) {
            throw new HttpException(500, Yii::t('InstallerModule.base', 'Shop is already installed!'));
        }

        // Cancel csrf validate for installer module.
        Yii::$app->controller->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Checks if database connections works
     *
     * @return boolean state of database connection
     */
    public function checkDBConnection()
    {

        try {
            // call setActive with true to open connection.
            Yii::$app->db->open();
            // return the current connection state.
            return Yii::$app->db->getIsActive();
        } catch (Exception $e) {

        } catch (\PDOException $e) {

        }
        return false;
    }

    /**
     * Checks if the application is already configured.
     */
    public function isConfigured()
    {
        if (Yii::$app->settings->get('secret') != "") {
            return true;
        }
        return false;
    }

    /**
     * Sets application in installed state (disables installer)
     */
    public function setInstalled()
    {
        $config = DynamicConfig::load();
        $config['params']['installed'] = true;
        DynamicConfig::save($config);
    }

    /**
     * Sets application database in installed state
     */
    public function setDatabaseInstalled()
    {
        $config = DynamicConfig::load();
        $config['params']['databaseInstalled'] = true;
        DynamicConfig::save($config);
    }

    protected function initConfigSteps()
    {
        /**
         * Step:  Basic Configuration, set the shopping platform name.
         */
        $this->configSteps['basic'] = [
            'sort' => 100,
            'url' => Url::to(['/installer/config/basic']),
            'isCurrent' => function () {
                return (Yii::$app->controller->id == 'config' && Yii::$app->controller->action->id == 'basic');
            },
        ];

        /**
         * Step:  Setup Admin User
         */
        $this->configSteps['admin'] = [
            'sort' => 200,
            'url' => Url::to(['/installer/config/admin']),
            'isCurrent' => function () {
                return (Yii::$app->controller->id == 'config' && Yii::$app->controller->action->id == 'admin');
            },
        ];

        /**
         * Step:  Finish the configuration.
         */
        $this->configSteps['finish'] = [
            'sort' => 300,
            'url' => Url::to(['/installer/config/finish']),
            'isCurrent' => function () {
                return (Yii::$app->controller->id == 'config' && Yii::$app->controller->action->id == 'finish');
            },
        ];

        $this->trigger(self::EVENT_INIT_CONFIG_STEPS);
    }

    /**
     * Get Next Step
     */
    public function getNextConfigStepUrl()
    {
        $foundCurrent = false;
        foreach ($this->configSteps as $step) {
            if ($foundCurrent) {
                return $step['url'];
            }

            if (call_user_func($step['isCurrent'])) {
                $foundCurrent = true;
            }
        }

        return $this->configSteps[0]['url'];
    }

    /**
     * Sorts all configSteps on sort attribute
     */
    protected function sortConfigSteps()
    {
        usort($this->configSteps, function ($a, $b) {
            return ($a['sort'] > $b['sort']) ? 1 : -1;
        });
    }

}
