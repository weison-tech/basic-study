<?php

return [
    'id' => 'admin',
    'class' => \core\modules\admin\Module::className(),
    'isCoreModule' => true,
    'modules' => [
        'rbac' => [
            'class' => 'core\modules\admin\modules\rbac\Module',
        ],
    ],
];
