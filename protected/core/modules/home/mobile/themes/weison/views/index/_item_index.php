<a href="#">
    <dl class="hot-sale-item bBor">
        <dt><img src="<?= $model->img ? $model->img->getPreviewImageUrl(200, 200) : '/img/no_image.png' ?>" alt=""></dt>
        <dd class="hot-sale-name"><?= $model->short_name ?></dd>
        <dd class="hot-sale-price">
            <span class="cur-price"><i>￥</i>100.<i>00</i></span>
            <span class="old-price"><i>￥</i>200.<i>00</i></span>
        </dd>
        <dd class="hot-sale-num">销量：12</dd>
        <dd class="hot-sale-vd">
            <i class="index-icon"></i>
            300
        </dd>
    </dl>
</a>