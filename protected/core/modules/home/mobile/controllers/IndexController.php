<?php
namespace core\modules\home\mobile\controllers;

use core\modules\home\components\Controller;
use core\modules\goods\models\search\GoodsSearch;
use core\modules\contents\models\Ad;

class IndexController extends Controller
{
    /**
     * Home Index
     */
    public function actionIndex()
    {
        $searchModel = new GoodsSearch();

        //Hot goods list dataProvider.
        $hotGoodsDataProvider = $searchModel->searchTag('is_hot');

        //Banner slider items.
        $banners = Ad::find()->joinWith('position')->where([
            'position_id' => 1,
            'type' => Ad::TYPE_SLIDE,
            Ad::tableName() . '.status' => Ad::STATUS_ENABLED,
        ])->all();

        $bannerItems = [];
        foreach($banners as $banner) {
            $item['title'] = $banner->name;
            $item['image'] = $banner->img ?
                $banner->img->getPreviewImageUrl($banner->position->width, $banner->position->height) :
                '';
            $item['sortOrder'] = $banner['order'];
            $item['url'] = $banner->url;
            $bannerItems[] = $item;
        }

        $this->layout = 'index';

        return $this->render('index', [
            'hotGoodsDataProvider' => $hotGoodsDataProvider,
            'bannerItems' => $bannerItems,
        ]);
    }
}
