<?php
namespace core\modules\home\mobile\themes\weison\assets;

use yii\web\AssetBundle;

class IndexAsset extends AssetBundle
{

    public $basePath = '@webroot/themes/weison';

    public $baseUrl = '@web/themes/weison';

    public $css = [
        'css/page/index.css',
    ];

    public $js = [
        'js/page/index.js',
    ];
}
