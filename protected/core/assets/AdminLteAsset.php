<?php
namespace core\assets;

class AdminLteAsset extends \dmstr\web\AdminLteAsset
{
    public $jsOptions = ['position' => \yii\web\View::POS_BEGIN];

    public $depends = [
        'rmrevin\yii\fontawesome\AssetBundle',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
