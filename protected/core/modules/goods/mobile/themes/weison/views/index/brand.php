<!-- content start -->

<div class="app-warp" style="overflow: hidden; padding-bottom: 0;">
    <aside class="category_left" style="height: 100%;">
        <ul>
            <?php foreach($brands as $brand) { ?>
                <li data-id="<?= $brand->id ?>">
                    <a href="#"><?= $brand->name?></a>
                </li>
            <?php } ?>
        </ul>
    </aside>

    <div class="category_right">

        <?php foreach($brands as $brand) { ?>
            <section data-id="<?= $brand->id ?>">
                <p style="text-align: center;">
                    <img style="width: 50%;" src="<?= $brand->logoImg->getPreviewImageUrl(200, 200) ?>">
                </p>
                <br>
                <?= $brand->description ?>
            </section>

            <div class="brand-bottom-btn">
                <a href="javascript:go()">立即选购</a>
            </div>
            
        <?php } ?>
    </div>

</div>

<script type="text/javascript">
    function go()
    {
        var brand_id = $('.category_left li.active').attr('data-id');
        location.href = "/index.php/Mobile/Goods/attr_search.html" + "?brand_id=" + brand_id;
    }
</script>





