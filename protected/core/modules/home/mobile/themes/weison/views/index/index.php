<?php
    use yii\widgets\ListView;
    use kop\y2sp\ScrollPager;
    use core\modules\home\mobile\widgets\Shortcut;
    use core\modules\home\mobile\widgets\Slider;
    use core\modules\home\mobile\widgets\Entrance;
?>

<!-- header start -->
<header id="top-bar" class="mui-bar mui-bar-nav">
    <a class="mui-pull-left index-icon message-icon" href="#">
        <span id="badge" class="mui-badge mui-badge-danger">2</span>
    </a>
    <div class="top-search">
        <i class="index-icon search-icon"></i>
        <input type="text" name="search" onfocus="this.blur();" class="top-search-input" placeholder="华为">
    </div>
    <a id="info" class="mui-pull-right head-login" href="#">登录</a>
</header>

<!--遮罩层-->
<div class="linear"></div>
<!-- header end -->

<div class="app-warp">
    <!-- banner start -->
    <?= Slider::widget(['items' => $bannerItems, 'height' => '250px', 'auto' => 3000, 'loop' => true]) ?>
    <!-- banner end -->

    <!-- index shortcut column start -->
    <?= Shortcut::widget() ?>
    <!-- index shortcut column end -->

    <!-- index-entrance start -->
    <?= Entrance::widget() ?>
    <!-- index-entrance end -->

    <!-- index-hot-sale start -->
    <div class="hot-sale bBor">
        <div class="hot-sale-hd tBor">
            <div class="m-title bBor">
                <h2><?= Yii::t('HomeModule.mobile_views_index_index', 'Hot Goods')?></h2>
            </div>
        </div>

        <div class="hot-sale-bd" id="hot_goods">
            <?= ListView::widget([
                'layout' => "{items}\n{pager}",
                'dataProvider' => $hotGoodsDataProvider,
                'itemOptions' => ['class' => 'item'],
                'itemView' => '_item_index',
                'pager' => [
                    'class' => ScrollPager::className(),
                    'spinnerTemplate' => '<div class="ias-spinner" style="text-align: center;">
                        <img style="width: 25px;height: 25px;" src="{src}" />
                        </div>',
                    'enabledExtensions' => [
                        ScrollPager::EXTENSION_TRIGGER,
                        ScrollPager::EXTENSION_SPINNER,
                        ScrollPager::EXTENSION_NONE_LEFT,
                        ScrollPager::EXTENSION_PAGING,
                    ],
                    'triggerText' => Yii::t('base', 'Load more items'),
                    'noneLeftText' => Yii::t('base', 'You reached the end'),
                ]
            ]) ?>
        </div>
    </div>
    <!-- index-hot-sale end -->

</div>


<!-- search start -->
<div id="search_hide" class="search_hide" style="position: fixed; top: 0px; width: 100%; z-index: 999;">
    <h2> <span class="close"><img src="/themes/weison/img/close.png"></span>关键搜索</h2>
    <div id="mallSearch" class="search_mid">
        <div id="search_tips" style="display:none;"></div>
        <ul class="search-type">
            <li class="cur" num="0">宝贝</li>
            <!--<li  num="1">店铺</li>-->
        </ul>
        <div class="searchdotm">
            <form class="set_ip" name="sourch_form" id="sourch_form" method="get" action="">
                <div class="mallSearch-input">
                    <div id="s-combobox-135">
                        <input class="s-combobox-input" name="q" id="q" placeholder="请输入关键词" type="text" value="">
                    </div>
                    <input type="button" value="" class="button" onclick="if($.trim($('#q').val()) != '') $('#sourch_form').submit();">
                </div>
            </form>
        </div>
    </div>
    <section class="mix_recently_search"><h3>热门搜索</h3>
        <ul>
            <foreach name="yhshop_config.hot_keywords" item="wd" key="k">
                <li><a href="" class="ht">华为</a></li>
            </foreach>
        </ul>
    </section>
</div>
<!-- search end -->
