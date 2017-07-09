<?php
namespace core\modules\user;

class Module extends \core\components\Module
{
    public $controllerNamespace = 'core\modules\user\controllers';

    public $defaultRoute = 'index';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
