<?php

use core\modules\home\mobile\widgets\Shortcut;

return [
    'id' => 'order',
    'class' => \core\modules\order\Module::className(),
    'isCoreModule' => true,
    'events' => [
        ['class' => Shortcut::className(), 'event' => Shortcut::EVENT_INIT, 'callback' => ['core\modules\order\Events', 'onShortcutInit']],
    ],
];
?>