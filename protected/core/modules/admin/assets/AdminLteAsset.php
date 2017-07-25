<?php
namespace core\modules\admin\assets;

class AdminLteAsset extends \dmstr\web\AdminLteAsset
{
    public $jsOptions = ['position' => \yii\web\View::POS_BEGIN];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
    ];
}
