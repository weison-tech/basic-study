<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model core\modules\goods\models\GoodsCategory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('GoodsModule.views_goods_category_index', 'Goods Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-category-view">

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'short_name',
            [
                'attribute'=>'parent_id',
                'value'=> $model->parent ? $model->parent->name : '-',
                'format' => 'raw',
            ],
            'sort_order',
            [
                'attribute'=>'image',
                'value'=>$model->img ? $model->img->getPreviewImageUrl(200, 200) : '-',
                'format' => $model->img ? ['image',['width'=>'100','height'=>'100']] : 'raw',
            ],
            [
                'attribute'=>'status',
                'value'=> $model::getStatus($model->status),
                'format' => 'raw',
            ],
        ],
    ]) ?>

</div>
