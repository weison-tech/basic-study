<?php
namespace core\modules\admin\assets;

use yii\web\AssetBundle;

class AdminLteAsset extends AssetBundle
{
    public $sourcePath = '@core/modules/admin/resources';

    public $js = [
        'js/admin_layout_setting.js',
        'js/jquery.slimscroll.min.js',
        'js/yii_overrides.js', // Override yii default alert to layer alert.
    ];

    public $depends = [
        'core\assets\JqueryAsset',
        'weison\alert\LayerAsset', // Import layer alert's js and css.
        'dmstr\web\AdminLteAsset', //Import admin lte theme assets.
    ];
}
