<?php
namespace core\modules\order;

use Yii;

/**
 * CustomPagesEvents
 */
class Events extends \yii\base\Object
{
    /**
     * Add menu item about user to mobile bottom nav.
     * @param $event
     */
    public static function onShortcutInit($event)
    {
        $event->sender->addItem(
            array(
                'label' => Yii::t('OrderModule.base', 'My Order'),
                'icon' => '/themes/weison/img/index-icon03.png',
                'url' => '#',
                'sortOrder' => 3,
            )
        );
    }
}
