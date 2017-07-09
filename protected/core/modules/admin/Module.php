<?php
namespace core\modules\admin;

class Module extends \core\components\Module
{
    public $controllerNamespace = 'core\modules\admin\controllers';

    public $defaultRoute = 'index';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
