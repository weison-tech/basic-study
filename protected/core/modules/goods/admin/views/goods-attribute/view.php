<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model core\modules\goods\models\GoodsAttribute */

$this->title = $model->attr_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('GoodsModule.base', 'Goods Attributes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-attribute-view">

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
            'attr_name',
            [
                'attribute'=>'type_id',
                'value'=> $model->type->name,
                'format' => 'raw',
            ],
            [
                'attribute'=>'attr_type',
                'value'=> $model::getAttributeType($model->attr_type),
                'format' => 'raw',
            ],
            [
                'attribute'=>'attr_input_type',
                'value'=> $model::getInputType($model->attr_input_type),
                'format' => 'raw',
            ],
            [
                'attribute'=>'attr_values',
                'value'=> $model->attr_values ?: '-',
                'format' => 'ntext',
            ],
            'order',
        ],
    ]) ?>

</div>
