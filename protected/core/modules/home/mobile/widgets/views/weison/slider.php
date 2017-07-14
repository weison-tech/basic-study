<?php if (is_array($items) && count($items)) { ?>

<div id="slider" class="index-banner mui-slider" >

    <div class="mui-slider-group <?= $loop ? 'mui-slider-loop' : '' ?>">

        <!--If need loop mui should add two additional item, this is the one-->
        <?php if ($loop) {
            $last = $items[count($items) - 1];
        ?>
            <div class="mui-slider-item mui-slider-item-duplicate">
                <a title="<?= $last['title'] ?>" href="<?= $last['url'] ?>" >
                    <img src="<?= $last['image'] ?>" style="width:<?= $width ?>;height:<?= $height ?>" />
                </a>
            </div>
        <?php } ?>

        <!--Show the all slider items-->
        <?php $i = 1;
        foreach ($items as $item) { ?>
            <div class="mui-slider-item <?= $i == 1 ? 'mui-active' : '' ?>">
                <a title="<?= $item['title'] ?>" href="<?= $item['url'] ?>" >
                    <img src="<?= $item['image'] ?>" style="width:<?= $width ?>;height:<?= $height ?>" />
                </a>
            </div>
        <?php $i++; } ?>

        <!--If need loop mui should add two additional item, this is the two.-->
        <?php if ($loop) {
            $first = $items[0];
        ?>
            <div class="mui-slider-item mui-slider-item-duplicate">
                <a title="<?= $first['title'] ?>" href="<?= $first['url'] ?>" >
                    <img src="<?= $first['image'] ?>" style="width:<?= $width ?>;height:<?= $height ?>" />
                </a>
            </div>
        <?php } ?>


    </div>

    <div class="mui-slider-indicator">
        <?php for ($i = 1; $i <= count($items); $i++) { ?>
            <div class="mui-indicator <?= $i == 1 ? 'mui-active' : '' ?>"></div>
        <?php } ?>
    </div>

</div>

<?php } ?>

<?php if ($auto > 0) { ?>
<script type="text/javascript">
    window.onload = function () {
        var gallery = mui(".mui-slider");
        var auto_time = <?= $auto ?>;
        gallery.slider({
            interval: auto_time
        });
    }
</script>
<?php } ?>