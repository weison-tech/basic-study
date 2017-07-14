<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii2mod\editable\EditableColumn;

/* @var $this yii\web\View */
/* @var $searchModel core\modules\goods\models\search\GoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('GoodsModule.base', 'Goods');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-index">

    <div class="navbar navbar-default">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <p>
        <?= Html::a(Yii::t('GoodsModule.base', 'Create Goods'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'original_img',
                'content' => function ($model) {
                    return $model->img ? Html::img($model->img->getPreviewImageUrl(200, 200),
                        ['style' => 'width:100px;height:100px;']) : '-';
                },
            ],
            'name',
            'sn',
            'price',
            [
                'class' => EditableColumn::className(),
                'attribute' => 'stock',
                'url' => ['change-stock'],
            ],
            [
                'attribute' => 'is_on_sale',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->is_on_sale ?
                        "<i class='fa fa-check-circle' 
                            style='color: green; font-size: 25px; cursor: pointer;' 
                            onclick='changeValue(this, \"is_on_sale\")'
                            data-id='". $model->id ."'" . "                           
                        ></i>" :
                        "<i class='fa fa-times-circle' 
                            style='color: red; font-size: 25px; cursor: pointer;'
                            onclick='changeValue(this, \"is_on_sale\")'
                            data-id='". $model->id ."'" . "                    
                        ></i>";
                },
            ],
            [
                'attribute' => 'is_recommend',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->is_recommend ?
                        "<i class='fa fa-check-circle' 
                            style='color: green; font-size: 25px; cursor: pointer;' 
                            onclick='changeValue(this, \"is_recommend\")'
                            data-id='". $model->id ."'" . "                           
                        ></i>" :
                        "<i class='fa fa-times-circle' 
                            style='color: red; font-size: 25px; cursor: pointer;'
                            onclick='changeValue(this, \"is_recommend\")'
                            data-id='". $model->id ."'" . "                    
                        ></i>";
                },
            ],
            [
                'attribute' => 'is_new',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->is_new ?
                        "<i class='fa fa-check-circle' 
                            style='color: green; font-size: 25px; cursor: pointer;' 
                            onclick='changeValue(this, \"is_new\")'
                            data-id='". $model->id ."'" . "                           
                        ></i>" :
                        "<i class='fa fa-times-circle' 
                            style='color: red; font-size: 25px; cursor: pointer;'
                            onclick='changeValue(this, \"is_new\")'
                            data-id='". $model->id ."'" . "                    
                        ></i>";
                },
            ],
            [
                'attribute' => 'is_hot',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->is_hot ?
                        "<i class='fa fa-check-circle' 
                            style='color: green; font-size: 25px; cursor: pointer;' 
                            onclick='changeValue(this, \"is_hot\")'
                            data-id='". $model->id ."'" . "                           
                        ></i>" :
                        "<i class='fa fa-times-circle' 
                            style='color: red; font-size: 25px; cursor: pointer;'
                            onclick='changeValue(this, \"is_hot\")'
                            data-id='". $model->id ."'" . "                    
                        ></i>";
                },
            ],
            [
                'class' => EditableColumn::className(),
                'attribute' => 'sort',
                'url' => ['change-sort'],
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
    /**
     * Ajax change value.
     * @param o
     * @param field
     */
    function changeValue(o, field) {
        var url = "<?= Url::to(['change-value']) ?>";
        var data = {id:$(o).attr('data-id'), field: field};
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

