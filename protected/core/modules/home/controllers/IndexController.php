<?php
namespace core\modules\home\controllers;

use core\modules\home\components\Controller;

class IndexController extends Controller
{
    /**
     * Home Index
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
