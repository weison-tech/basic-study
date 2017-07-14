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
        ['class' => BottomNav::className(), 'event' => BottomNav::EVENT_INIT, 'callback' => ['core\modules\goods\Events', 'onBottomNavInit']],
        ['class' => Shortcut::className(), 'event' => Shortcut::EVENT_INIT, 'callback' => ['core\modules\goods\Events', 'onShortcutInit']],
        ['class' => Entrance::className(), 'event' => Entrance::EVENT_INIT, 'callback' => ['core\modules\goods\Events', 'onEntranceInit']],
    ],
    'modules' => [
        'admin' => [
            'class' => 'core\modules\goods\admin\Module'
        ],
        'mobile' => [
            'class' => 'core\modules\goods\mobile\Module'
        ],
    ],
];
