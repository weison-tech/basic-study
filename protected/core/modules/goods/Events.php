<?php
namespace core\modules\goods;

use Yii;

/**
 * CustomPagesEvents
 */
class Events extends \yii\base\Object
{

    /**
     * Add menu item about goods to Admin menu.
     * @param $event
     */
    public static function onAdminMenuInit($event)
    {
        $event->sender->addItem(array(
            'label' => Yii::t('GoodsModule.base', 'Goods Management'),
            'icon' => 'fa fa-book',
            'url' => '#',
            'sortOrder' => 9,
            'items' => [
                ['label' => Yii::t('GoodsModule.base', 'Goods Category'), 'icon' => 'fa fa-circle-o', 'url' => ['/goods/admin/goods-category'],],
                ['label' => Yii::t('GoodsModule.base', 'Goods List'), 'icon' => 'fa fa-circle-o', 'url' => ['/goods/admin/goods'],],
                ['label' => Yii::t('GoodsModule.base', 'Goods Type'), 'icon' => 'fa fa-circle-o', 'url' => ['/goods/admin/goods-type'],],
                ['label' => Yii::t('GoodsModule.base', 'Goods Specifications'), 'icon' => 'fa fa-circle-o', 'url' => ['/goods/admin/spec-name'],],
                ['label' => Yii::t('GoodsModule.base', 'Goods Attributes'), 'icon' => 'fa fa-circle-o', 'url' => ['/goods/admin/goods-attribute'],],
                ['label' => Yii::t('GoodsModule.base', 'Brand List'), 'icon' => 'fa fa-circle-o', 'url' => ['/goods/admin/brand'],],
                ['label' => Yii::t('GoodsModule.base', 'Goods Comments'), 'icon' => 'fa fa-circle-o', 'url' => ['/goods/admin/comments'],],
                ['label' => Yii::t('GoodsModule.base', 'Goods Consultation'), 'icon' => 'fa fa-circle-o', 'url' => ['/goods/admin/consultation'],],
            ],
        ));
    }

    /**
     * Add menu item about goods to mobile bottom nav.
     * @param $event
     */
    public static function onBottomNavInit($event)
    {
        $event->sender->addItem(
            array(
                'label' => Yii::t('GoodsModule.base', 'Category'),
                'icon' => 'mui-icon mui-icon-bars',
                'url' => '#',
                'sortOrder' => 2,
                //TODO add active property based on url.
            )
        );

        $event->sender->addItem(
            array(
                'label' => Yii::t('GoodsModule.base', 'Cart'),
                'icon' => 'mui-icon mui-icon-extra mui-icon-extra-cart',
                'url' => '#',
                'sortOrder' => 3,
                //TODO add active property based on url.
            )
        );

    }


    /**
     * Add menu item about goods to mobile shortcut.
     * @param $event
     */
    public static function onShortcutInit($event)
    {
        $event->sender->addItem(
            array(
                'label' => Yii::t('GoodsModule.base', 'Settled Brand'),
                'icon' => '/themes/weison/img/index-icon01.png',
                'url' => '/goods/mobile/index/brand',
                'sortOrder' => 1,
            )
        );

        $event->sender->addItem(
            array(
                'label' => Yii::t('GoodsModule.base', 'Boutique'),
                'icon' => '/themes/weison/img/index-icon02.png',
                'url' => '#',
                'sortOrder' => 2,
            )
        );
    }

    /**
     * Add menu item about goods to mobile shortcut.
     * @param $event
     */
    public static function onEntranceInit($event)
    {
        $event->sender->addItem(
            array(
                'label' => Yii::t('GoodsModule.base', 'Settled Brand'),
                'icon' => '/themes/weison/img/index_nav1.jpg',
                'url' => '#',
                'sortOrder' => 1,
            )
        );

        $event->sender->addItem(
            array(
                'label' => Yii::t('GoodsModule.base', 'Boutique'),
                'icon' => '/themes/weison/img/index_nav2.jpg',
                'url' => '#',
                'sortOrder' => 2,
            )
        );
    }
}
