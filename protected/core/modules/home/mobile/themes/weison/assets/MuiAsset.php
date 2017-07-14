<?php
namespace core\modules\home\mobile\themes\weison\assets;

use yii\web\AssetBundle;

class MuiAsset extends AssetBundle
{

    public $basePath = '@webroot/themes/weison';
    public $baseUrl = '@web/themes/weison';
    public $css = [
        'css/mui.min.css',
        'css/icons-extra.css',
    ];

    public $js = [
        'js/mui.min.js',
    ];
}
