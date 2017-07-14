<?php
namespace core\modules\goods\mobile;

use Yii;

class Module extends \core\components\Module
{
    public $controllerNamespace = 'core\modules\goods\mobile\controllers';

    public function init()
    {
        parent::init();

        $theme = Yii::$app->view->theme->name;

        Yii::$app->view->theme->pathMap = [
            "@shop/modules/goods/mobile/views" => "@shop/modules/goods/mobile/themes/$theme/views",
        ];
        $this->layout = '@shop/modules/goods/mobile/views/layouts/main.php';
    }
}
