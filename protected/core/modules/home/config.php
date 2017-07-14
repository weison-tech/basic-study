<?php

return [
    'id' => 'home',
    'class' => \core\modules\home\Module::className(),
    'isCoreModule' => true,
    'urlManagerRules' => [
        'home' => 'home/index'
    ],
    'modules' => [
        'mobile' => [
            'class' => 'core\modules\home\mobile\Module'
        ],
    ],
];
