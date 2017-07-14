<?php
namespace core\modules\goods\mobile\controllers;

use Yii;
use core\modules\goods\models\Brand;
use core\modules\home\components\Controller;

class IndexController extends Controller
{
    public function init()
    {
        parent::init();
        $this->actionTitlesMap = [
            'brand' => Yii::t('GoodsModule.base', 'Settled Brand'),
        ];
    }

    /**
     * Index brand.
     */
    public function actionBrand()
    {
        $brands = Brand::find()->where(['status' => Brand::STATUS_ENABLED])->orderBy('sort asc')->all();
        return $this->render('brand', ['brands' => $brands]);
    }
}
