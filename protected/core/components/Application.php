<?php

/**
 * @link http://www.itweshare.com
 * @copyright Copyright (c) 2017 Itweshare
 * @author xiaomalover <xiaomalover@gmail.com>
 */

namespace core\components;

use yii;

/**
 * Application for web.
 * @package core\components
 */
class Application extends \yii\web\Application
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'core\\controllers';

    /**
     * @inheritdoc
     */
    public function bootstrap()
    {
        $request = $this->getRequest();

        //This is the root static url.
        if (Yii::getAlias('@web-static', false) === false) {
            Yii::setAlias('@web-static', $request->getBaseUrl() . '/static');
        }

        //This is the root static directory
        if (Yii::getAlias('@webroot-static', false) === false) {
            Yii::setAlias('@webroot-static', '@webroot/static');
        }

        parent::bootstrap();
    }

}
