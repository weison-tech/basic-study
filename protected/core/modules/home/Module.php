<?php
namespace core\modules\home;

use Yii;

class Module extends \core\components\Module
{
    public $controllerNamespace = 'core\modules\home\controllers';

    public function init()
    {
        parent::init();

        $theme = Yii::$app->view->theme->name;

        Yii::$app->view->theme->pathMap = [
            "@shop/modules/home/views" => "@shop/modules/home/themes/$theme/views",
        ];
        $this->layout = '@shop/modules/home/views/layouts/main.php';
    }
}
