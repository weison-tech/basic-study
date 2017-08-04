<?php
/**
 * @link http://www.itweshare.com
 * @copyright Copyright (c) 2017 Itweshare
 * @author xiaomalover <xiaomalover@gmail.com>
 */

Yii::setAlias('@webroot', realpath(__DIR__ . '/../../../'));
Yii::setAlias('@app', '@webroot/protected');
Yii::setAlias('@core', '@app/core');

$config = [
    'name' => 'basic',
    'version' => '1.0.0',
    'basePath' => '@app', //Application base path.
    'viewPath' => '@core/views',
    'bootstrap' => ['log', 'core\components\bootstrap\ModuleAutoLoader'],
    'components' => [
        'moduleManager' => [
            'class' => '\core\components\ModuleManager'
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,//Hidden index.php
            //'enableStrictParsing' => false,
            'suffix' => '.html',
            'rules' => [
                //'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ],
        ],

        'settings' => [
            'class' => 'core\components\SettingsManager',
            'moduleId' => 'base',
        ],

        'i18n' => [
            'class' => 'core\components\i18n\I18N',
            'translations' => [
                'base' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@core/messages'
                ],
                'error' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@core/messages'
                ],
            ],
        ],
        'view' => [
            'class' => '\core\components\View',
            'theme' => [
                'class' => '\core\components\Theme',
                'name' => 'default',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest', 'admin']
        ],
    ],

    'params' => [
        'installed' => false,
        'databaseInstalled' => false,
        'dynamicConfigFile' => '@core/config/dynamic.php', //This config generate by application.
        'moduleAutoloadPaths' => ['@webroot/protected/modules', '@core/modules'],
        'moduleMarketplacePath' => '@webroot/protected/modules',
        'availableLanguages' => [
            'en' => 'English (US)',
            'zh_cn' => '中文(简体)',
        ],
        'allowedLanguages' => [],
    ],

    'as access' => [
        'class' => core\modules\admin\modules\rbac\filters\AccessControl::class,
        'allowActions' => [
            'admin/index/*',
            'admin/rbac/*', //When application in product environment, this line should be deleted.
        ],
        'user' => 'admin',
    ],
];

return $config;
