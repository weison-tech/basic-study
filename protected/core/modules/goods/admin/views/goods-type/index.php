<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel core\modules\goods\models\search\GoodsTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('GoodsModule.base', 'Goods Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-type-index">

    <p>
        <?= Html::a(Yii::t('GoodsModule.base', 'Create Goods Type'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
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
            ],
        ],
    ]); ?>
</div>
