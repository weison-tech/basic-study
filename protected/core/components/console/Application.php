<?php

/**
 * @link http://www.itweshare.com
 * @copyright Copyright (c) 2017 Itweshare
 * @author xiaomalover <xiaomalover@gmail.com>
 */

namespace core\components\console;

use Yii;

/**
 * Application for console
 * @package core\console
 */
class Application extends \yii\console\Application
{
    /**
     * Checks if database is installed
     * @return boolean is database installed/migrated
     */
    public function isDatabaseInstalled()
    {
        if (in_array('setting', Yii::$app->db->schema->getTableNames())) {
            return true;
        }

        return false;
    }
}
