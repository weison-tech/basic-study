<?php
namespace core\assets;

use yii\web\AssetBundle;

class AdminLayoutAsset extends AssetBundle
{
    public $basePath = '@webroot/static';
    public $baseUrl = '@web/static';

    public $js = [
        'js/admin_layout_setting.js',
        'js/jquery.slimscroll.min.js',
        'js/yii_overrides.js', // Override yii default alert to layer alert.
    ];

    public $depends = [
        'weison\alert\LayerAsset', // Import layer alert's js and css
    ];
}
