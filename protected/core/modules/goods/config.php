<?php

use core\modules\admin\widgets\AdminMenu;
use core\modules\home\mobile\widgets\BottomNav;
use core\modules\home\mobile\widgets\Shortcut;
use core\modules\home\mobile\widgets\Entrance;

return [
    'id' => 'goods',
    'class' => \core\modules\goods\Module::className(),
    'isCoreModule' => true,
    'events' => [
        ['class' => AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['core\modules\goods\Events', 'onAdminMenuInit']],
    ],
    'modules' => [
        'admin' => [
            'class' => 'core\modules\goods\admin\Module'
        ],
    ],
];
