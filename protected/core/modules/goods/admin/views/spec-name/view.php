<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model core\modules\goods\models\SpecName */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('GoodsModule.base', 'Spec Names'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spec-name-view">

    <p>
        <?= Html::a(Yii::t('GoodsModule.base', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('GoodsModule.base', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('GoodsModule.base', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('GoodsModule.base', 'Back to list'), ['index'], ['class' => 'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute'=>'type_id',
                'value'=> $model->type->name,
                'format' => 'raw',
            ],
            'name',
            [
                'attribute'=>'value_items',
                'value'=> str_replace(PHP_EOL, ", ", $model->value_items),
                'format' => 'raw',
            ],
            'order',
        ],
    ]) ?>

</div>
