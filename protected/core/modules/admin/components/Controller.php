<?php

namespace core\modules\admin\components;

use yii\filters\VerbFilter;
use core\modules\admin\modules\rbac\filters\AccessControl;

/**
 * Base controller for administration section
 */
class Controller extends \yii\web\Controller
{
    public $layout = "@core/modules/admin/views/layouts/main";

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'allowActions' => [
                    'admin/index/*',
                    'admin/rbac/*', //When application in product environment, this line should be deleted.
                ],
                'user' => 'admin',
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
}
