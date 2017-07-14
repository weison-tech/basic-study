<?php
namespace core\modules\home\mobile;

use Yii;

class Module extends \core\components\Module
{
    public $controllerNamespace = 'core\modules\home\mobile\controllers';

    public function init()
    {
        parent::init();

        $theme = Yii::$app->view->theme->name;

        Yii::$app->view->theme->pathMap = [
            "@shop/modules/home/mobile/views" => "@shop/modules/home/mobile/themes/$theme/views",
        ];
        $this->layout = '@shop/modules/home/mobile/views/layouts/main.php';
    }
}
