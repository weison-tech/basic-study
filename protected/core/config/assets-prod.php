<?php
/**
 * This file is generated by the "yii asset" command.
 * DO NOT MODIFY THIS FILE DIRECTLY.
 * @version 2017-07-28 09:21:38
 */
return [
    'admin' => [
        'class' => 'yii\\web\\AssetBundle',
        'basePath' => '@webroot/assets',
        'baseUrl' => '@web/assets',
        'js' => [
            'all-admin-8be424c25b092065d36a5615144451d9.js',
        ],
        'css' => [
            'all-admin-f4d89b0692f101ae042c55d70540f5be.css',
        ],
        'sourcePath' => null,
        'depends' => [],
    ],
    'yii\\web\\JqueryAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'admin',
        ],
    ],
    'weison\\alert\\LayerAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'yii\\web\\JqueryAsset',
            'admin',
        ],
    ],
    'rmrevin\\yii\\fontawesome\\AssetBundle' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'admin',
        ],
    ],
    'yii\\web\\YiiAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'yii\\web\\JqueryAsset',
            'admin',
        ],
    ],
    'yii\\bootstrap\\BootstrapAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'admin',
        ],
    ],
    'yii\\bootstrap\\BootstrapPluginAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'yii\\web\\JqueryAsset',
            'yii\\bootstrap\\BootstrapAsset',
            'admin',
        ],
    ],
    'dmstr\\web\\AdminLteAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'rmrevin\\yii\\fontawesome\\AssetBundle',
            'yii\\web\\YiiAsset',
            'yii\\bootstrap\\BootstrapAsset',
            'yii\\bootstrap\\BootstrapPluginAsset',
            'admin',
        ],
    ],
    'core\\modules\\admin\\assets\\AdminLteAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'weison\\alert\\LayerAsset',
            'dmstr\\web\\AdminLteAsset',
            'admin',
        ],
    ],
];