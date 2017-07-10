<?php
/**
 * Configuration file for the "yii asset" console command.
 */

// In the console environment, some path aliases may not exist. Please define these:
Yii::setAlias('@webroot', __DIR__ . '/../web');
Yii::setAlias('@web', '/');

return [
    'jsCompressor' => 'gulp compress-js --gulpfile tools/gulp/gulpfile.js --src {from} --dist {to}',
    'cssCompressor' => 'gulp compress-css --gulpfile tools/gulp/gulpfile.js --src {from} --dist {to}',
    // Whether to delete asset source after compression:
    'deleteSource' => false,
    // The list of asset bundles to compress:
    // Asset bundle for compression output:
    'bundles' => [
        'app\assets\PageOneAsset',
        'app\assets\PageTwoAsset',
        'yii\bootstrap\BootstrapAsset',
    ],
    'targets' => [
        'allPage' => [
            'class' => 'yii\web\AssetBundle',
            'basePath' => '@webroot/assets',
            'baseUrl' => '@web/assets',
            'js' => 'all-page-{hash}.js',
            'css' => 'all-page-{hash}.css',
            'depends' => [
                'app\assets\PageOneAsset',
                'app\assets\PageTwoAsset',
                'yii\bootstrap\BootstrapAsset',
            ],
        ],
    ],

    // Asset manager configuration:
    'assetManager' => [
        'basePath' => '@webroot',
        'baseUrl' => '@web',
    ],

];
