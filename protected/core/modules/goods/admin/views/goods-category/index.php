<?php

use yii\helpers\Html;
use leandrogehlen\treegrid\TreeGrid;
use yii\helpers\Url;
use yii2mod\editable\EditableColumn;

//use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\modules\goods\models\search\GoodsCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('GoodsModule.views_goods_category_index', 'Goods Categories');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="goods-category-index">

    <p>
        <?= Html::a("<i class='fa fa-angle-double-down'></i> <span>" . Yii::t('GoodsModule.views_goods_category_index',
                'Open All') . '</span>', 'javascript:void(0)', ['class' => 'btn btn-info', 'id' => 'toggle']) ?>
        <?= Html::a(Yii::t('GoodsModule.views_goods_category_index', 'Create Goods Category'), ['create'],
            ['class' => 'btn btn-success']) ?>
    </p>
    <?= TreeGrid::widget([
        'dataProvider' => $dataProvider,
        'keyColumnName' => 'id',
        'parentColumnName' => 'parent_id',
        'parentRootValue' => '0', //first parentId value
        'pluginOptions' => [
            'initialState' => 'collapsed',
        ],
        'columns' => [
            'id',
            'name',
            'short_name',
            [
                'attribute' => 'parent_id',
                'value' => function ($model) {
                    return $model->parent ? $model->parent->name : '-';
                },
            ],
            [
                'class' => EditableColumn::className(),
                'attribute' => 'sort_order',
                'url' => ['change-sort'],
            ],
            [
                'attribute' => 'image',
                'content' => function ($model) {
                    return $model->img ? Html::img($model->img->getPreviewImageUrl(200, 200),
                        ['style' => 'width:100px;height:100px;']) : '-';
                },
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->status ?
                        "<i class='fa fa-check-circle' 
                            style='color: green; font-size: 25px; cursor: pointer;' 
                            onclick='changeStatus(this)'
                            data-id='". $model->id ."'" . "                           
                        ></i>" :
                        "<i class='fa fa-times-circle' 
                            style='color: red; font-size: 25px; cursor: pointer;'
                            onclick='changeStatus(this)'
                            data-id='". $model->id ."'" . "                    
                        ></i>";
                },
            ],
            [
                'label' => Yii::t('GoodsModule.base', 'Operation'),
                'format' => 'raw',
                'value' => function ($data) {
                    $viewUrl = Url::to(['view', 'id' => $data->id]);
                    $updateUrl = Url::to(['update', 'id' => $data->id]);
                    $deleteUrl = Url::to(['delete', 'id' => $data->id]);
                    return "<div class='btn-group'>" .
                    Html::a(Yii::t('GoodsModule.base', 'View'), $viewUrl,
                        ['title' => Yii::t('GoodsModule.base', 'View'), 'class' => 'btn btn-sm btn-info']) .
                    Html::a(Yii::t('GoodsModule.base', 'Update'), $updateUrl,
                        ['title' => Yii::t('GoodsModule.base', 'Update'), 'class' => 'btn btn-sm btn-primary']) .
                    Html::a(Yii::t('GoodsModule.base', 'Delete'), $deleteUrl, [
                        'title' => Yii::t('GoodsModule.base', 'Delete'),
                        'class' => 'btn btn-sm btn-danger',
                        'data-method' => 'post',
                        'data-confirm' => Yii::t('base', 'Are you sure you want to delete this item?')
                    ]) .
                    "</div>";
                },
                'options' => ['style' => 'width:175px;'],
            ]
        ],
    ]); ?>
</div>

<script type="text/javascript">
    $(function () {
        $("#toggle").click(function () {
            var flg = $(this).find("i");
            if (flg.hasClass('fa-angle-double-down')) {
                var close = "<?=Yii::t('GoodsModule.views_goods_category_index', 'Close All')?>";
                $(this).find('span').text(close);
                flg.removeClass('fa-angle-double-down');
                flg.addClass('fa-angle-double-up');

                $(".treegrid-expander-collapsed").each(function () {
                    $(this).click();
                })
            } else {
                var open = "<?=Yii::t('GoodsModule.views_goods_category_index', 'Open All')?>";
                $(this).find('span').text(open);
                flg.removeClass('fa-angle-double-up');
                flg.addClass('fa-angle-double-down');

                $(".treegrid-expander-expanded").each(function () {
                    $(this).click();
                })
            }
        })
    })

    /**
     * Ajax change status.
     * @param o
     */
    function changeStatus(o) {
        var url = "<?= Url::to(['change-status']) ?>";
        var data = {id:$(o).attr('data-id')};
        $.post(url, data, function (data) {
            var res =  eval('(' + data + ')');
            if (res.code == '200') {
                if($(o).hasClass('fa-times-circle')) {
                    $(o).removeClass('fa-times-circle');
                    $(o).addClass('fa-check-circle');
                    $(o).css('color', 'green');
                } else {
                    $(o).removeClass('fa-check-circle');
                    $(o).addClass('fa-times-circle');
                    $(o).css('color', 'red');
                }
            }
        });
    }
</script>