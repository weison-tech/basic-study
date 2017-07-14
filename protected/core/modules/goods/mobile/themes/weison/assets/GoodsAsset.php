<?php
namespace core\modules\goods\mobile\themes\weison\assets;

use yii\web\AssetBundle;

class GoodsAsset extends AssetBundle
{

    public $basePath = '@webroot/themes/weison';

    public $baseUrl = '@web/themes/weison';

    public $css = [
        'css/page/goods.css',
    ];

    public $js = [
        'js/page/goodsList.js',
        'js/filter.min.js',
        'js/page/goodsList.js',
        'js/page/categoryList.js'
    ];
}
