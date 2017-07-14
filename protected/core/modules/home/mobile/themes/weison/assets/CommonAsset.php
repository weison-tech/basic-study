<?php
namespace core\modules\home\mobile\themes\weison\assets;

use yii\web\AssetBundle;

class CommonAsset extends AssetBundle
{

    public $basePath = '@webroot/themes/weison';

    public $baseUrl = '@web/themes/weison';

    public $css = [
        'css/common.css',
        'css/icons-extra.css',
    ];

    public $js = [
        'js/page/common.js',
    ];

    public $depends = [
        'core\modules\home\mobile\themes\weison\assets\MuiAsset',
        'yii\web\YiiAsset',
    ];
}
