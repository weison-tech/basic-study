<?php
namespace core\modules\home\mobile\widgets;

use Yii;
use yii\helpers\Url;
use core\widgets\BaseMenu;

/**
 * Description of BottomNav
 */
class BottomNav extends BaseMenu
{
    public function init()
    {
        $this->options = ['class' => ''];
        $this->addItem(
            [
                'label' => Yii::t('HomeModule.mobile_widgets_BottomNav', 'Home'),
                'icon' => 'mui-icon mui-icon-home',
                'url' => Url::toRoute('/home/mobile/index'),
                'sortOrder' => 1,
                'active' => (
                    Yii::$app->controller->module &&
                    Yii::$app->controller->module->id == 'mobile' &&
                    Yii::$app->controller->id == "index"
                ),
            ]
        );

        return parent::init();
    }
}
