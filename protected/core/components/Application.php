<?php

/**
 * @link http://www.itweshare.com
 * @copyright Copyright (c) 2017 Itweshare
 * @author xiaomalover <xiaomalover@gmail.com>
 */

namespace core\components;

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

}
