<?php

/**
 * @link http://www.itweshare.com
 * @copyright Copyright (c) 2017 Itweshare
 * @author xiaomalover <xiaomalover@gmail.com>
 */

namespace core\components;

/**
 * @inheritdoc
 */
class View extends \yii\web\View
{
    /**
     * Registers a Javascript variable
     *
     * @param string $name
     * @param string $value
     */
    public function registerJsVar($name, $value)
    {
        $jsCode = "var " . $name . " = '" . addslashes($value) . "';\n";
        $this->registerJs($jsCode, View::POS_HEAD, $name);
    }
}
