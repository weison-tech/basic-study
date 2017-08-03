<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model core\modules\goods\models\Goods */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('GoodsModule.base', 'Goods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-view ">

    <p>
        <?= Html::a(Yii::t('GoodsModule.base', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('GoodsModule.base', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('base', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('GoodsModule.base', 'Back to list'), ['index'], ['class' => 'btn btn-info']) ?>
    </p>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
        <h3><?= Yii::t('GoodsModule.admin_views_goods_view', 'Goods Base Info')?></h3>
        <hr/>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'template' => '
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <span style="font-weight:bold;">{label}</span>: {value}
                                <hr/>
                            </div>
                       ',
        'attributes' => [
            'id',
            [
                'attribute'=>'goods_type',
                'value'=> $model->type ? $model->type->name : '-',
                'format' => 'raw',
            ],
            [
                'attribute'=>'category_id',
                'value'=> $model->category ? $model->category->name : '-',
                'format' => 'raw',
            ],
            [
                'attribute'=>'brand_id',
                'value'=> $model->brand ? $model->brand->name : '-',
                'format' => 'raw',
            ],
            'name',
            'short_name',
            'sn',
            'stock',
            'market_price',
            'price',
            'cost_price',
            [
                'attribute'=>'is_on_sale',
                'value'=> $model::getSaleStatus($model->is_on_sale),
                'format' => 'raw',
            ],
            'weight',
            [
                'attribute'=>'is_free_shipping',
                'value'=> $model->is_free_shipping ? Yii::t('base', 'Yes') : Yii::t('base', 'No'),
                'format' => 'raw',
            ],
            'keywords',
            'on_sale_at:datetime',
            'sort',
            [
                'attribute'=>'is_recommend',
                'value'=> $model->is_recommend ? Yii::t('base', 'Yes') : Yii::t('base', 'No'),
                'format' => 'raw',
            ],
            [
                'attribute'=>'is_new',
                'value'=> $model->is_new ? Yii::t('base', 'Yes') : Yii::t('base', 'No'),
                'format' => 'raw',
            ],
            [
                'attribute'=>'is_hot',
                'value'=> $model->is_hot ? Yii::t('base', 'Yes') : Yii::t('base', 'No'),
                'format' => 'raw',
            ],
            'updated_at:datetime',
            [
                'attribute'=>'comment_counts',
                'value'=> $model->comment_counts ?: 0,
                'format' => 'raw',
            ],
            'sales_sum',
        ],
    ]) ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
        <h3><?= Yii::t('GoodsModule.admin_views_goods_view', 'Goods Album Images')?></h3>
        <hr/>
        <?php if ($model->album) {
            foreach ($model->album as $img) {
            ?>
                <img src="<?=$img->getPreviewImageUrl(100, 100)?>" />
        <?php } }?>
    </div>

    <br/>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
        <h3><?= Yii::t('GoodsModule.admin_views_goods_view', 'Goods Detail Info')?></h3>
        <hr/>
        <?= $model->summary ?>
        <?= $model->description ?>
    </div>


</div>
