<?php
use core\modules\file\widgets\FileUploadButton;
use yii\helpers\Url;

?>

<?php if ($spec_list) { ?>

    <table class="table table-bordered" id="goods_spec">
        <tr>
            <td colspan="2">
                <b><?= Yii::t('GoodsModule.admin_views_goods_select-specification', 'Goods Specification') ?> </b></td>
        </tr>
        <?php foreach ($spec_list as $k => $v) { ?>
            <tr>
                <td><?= $v['name'] ?></td> <!--The specification name -->
                <td>
                    <?php foreach ($v['spec_item'] as $k2 => $v2) { ?>
                        <!-- Specification select button start -->
                        <button type="button" data-spec_id='<?= $v['id'] ?>' data-item_id='<?= $k2 ?>' class="btn
                        <?php
                            if (in_array($k2, $items_ids)) {
                                echo 'btn-success';
                            } else {
                                echo 'btn-default';
                            }
                        ?> ">
                            <?= $v2 ?>
                        </button>
                        <!-- Specification select button end -->

                        <!-- Specification image upload start-->
                        <?php foreach ($spec_image_list as $v3) {
                            if ($v3->spec_value_id == $k2) {
                                echo core\modules\file\widgets\ShowFiles::widget([
                                    'object' => $v3,
                                    'showerId' => 'spec_show_' . $k2,
                                    'width' => 30,
                                    'height' => 30
                                ]);
                            }
                        } ?>

                        <?= FileUploadButton::widget([
                            'uploaderId' => 'spec_upload_' . $k2,
                            //'object' => new core\modules\goods\models\SpecImage,
                            'multiple' => false,
                        ]); ?>
                        <!-- Specification image upload end-->
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>

    <!-- ajax return the sku list -->
    <div id="goods_spec_list"></div>

<?php } ?>


<script>
    //Init goods specification items.
    $(document).ready(function () {
        ajaxGetSpecInput();
    });

    //Change button class when click it.
    $("#goods_spec button").click(function () {
        if ($(this).hasClass('btn-success')) {
            $(this).removeClass('btn-success');
            $(this).addClass('btn-default');
        } else {
            $(this).removeClass('btn-default');
            $(this).addClass('btn-success');
        }
        //Get new items when click.
        ajaxGetSpecInput();
    });


    /**
     * Push user selected item value to arr before ajax request.
     */
    function ajaxGetSpecInput() {
        var spec_arr = {};
        $("#goods_spec button").each(function () {
            if ($(this).hasClass('btn-success')) {
                var spec_id = $(this).data('spec_id');
                var item_id = $(this).data('item_id');
                if (!spec_arr.hasOwnProperty(spec_id)) {
                    spec_arr[spec_id] = [];
                }
                spec_arr[spec_id].push(item_id);
            }
        });

        var goods_id = $("#goods_id").val();
        $.ajax({
            type: 'POST',
            data: {'spec_arr': spec_arr, 'goods_id': goods_id},
            url: "<?= Url::to(['ajax-get-spec'])?>",
            success: function (data) {
                $("#goods_spec_list").html('')
                $("#goods_spec_list").append(data);
                mergeCell();  //merge cell.
            }
        });
    }


    /**
     * Merge cell function.
     */
    function mergeCell() {
        var tab = document.getElementById("spec_input_tab");
        var maxCol = 2, val, count, start;
        if (tab != null) {
            for (var col = maxCol - 1; col >= 0; col--) {
                count = 1;
                val = "";
                for (var i = 0; i < tab.rows.length; i++) {
                    if (val == tab.rows[i].cells[col].innerHTML) {
                        count++;
                    } else {
                        if (count > 1) {
                            start = i - count;
                            tab.rows[start].cells[col].rowSpan = count;
                            for (var j = start + 1; j < i; j++) {
                                tab.rows[j].cells[col].style.display = "none";
                            }
                            count = 1;
                        }
                        val = tab.rows[i].cells[col].innerHTML;
                    }
                }
                if (count > 1) {
                    start = i - count;
                    tab.rows[start].cells[col].rowSpan = count;
                    for (var j = start + 1; j < i; j++) {
                        tab.rows[j].cells[col].style.display = "none";
                    }
                }
            }
        }
    }
</script>
