<?php
namespace core\modules\installer\libs;

use Yii;

/**
 * InitialData
 */
class InitialData
{

    public static function bootstrap()
    {
        // Seems database is already initialized
        if (Yii::$app->settings->get('paginationSize') == 10) {
            return;
        }

        Yii::$app->settings->set('baseUrl', \yii\helpers\BaseUrl::base(true));
        Yii::$app->settings->set('paginationSize', 10);

        // Caching
        Yii::$app->settings->set('cache.class', 'yii\caching\FileCache');
        Yii::$app->settings->set('cache.expireTime', '3600');

        // Design
        Yii::$app->settings->set('theme', "default");

        // Basic
        Yii::$app->settings->set('defaultLanguage', Yii::$app->language);
    }
}
