<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model core\modules\goods\models\Brand */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('GoodsModule.base', 'Brands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-view">

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
            [
                'attribute'=>'logo',
                'value'=> $model->logoImg ? $model->logoImg->getPreviewImageUrl(200, 200) : '-',
                'format' => $model->logoImg ? ['image',['width'=>'100','height'=>'100']] : 'raw',
            ],
            'id',
            'name',
            'description:ntext',
            [
                'attribute'=>'url',
                'format' => ['url', ['target' => '_blank']],
            ],
            [
                'attribute'=>'status',
                'value'=> $model::getStatus($model->status),
                'format' => 'raw',
            ],
            'sort',
            [
                'attribute'=>'category_id',
                'value'=> $model->category ? $model->category->name : '-',
                'format' => 'raw',
            ],
        ],
    ]) ?>

</div>
