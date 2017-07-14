<?php
namespace core\modules\home\components;

use core\components\behaviors\DeviceSwitcher;

/**
 * Base controller for administration section
 */
class Controller extends \core\components\Controller
{
    public function behaviors()
    {
        return [
            'device-switcher' => [
                'class' => DeviceSwitcher::className(),
            ]
        ];
    }
}
