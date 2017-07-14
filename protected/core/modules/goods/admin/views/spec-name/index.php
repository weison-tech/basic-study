<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii2mod\editable\EditableColumn;

/* @var $this yii\web\View */
/* @var $searchModel core\modules\goods\models\search\SpecNameSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('GoodsModule.base', 'Spec Names');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spec-name-index">

    <div class="navbar navbar-default">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <p>
        <?= Html::a(Yii::t('GoodsModule.base', 'Create Spec Name'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'type_id',
                'content' => function ($model) {
                    return $model->type->name;
                },
            ],
            'name',
            [
                'attribute' => 'value_items',
                'content' => function ($model) {
                    return str_replace(PHP_EOL, ", ", $model->value_items);
                },
            ],
            [
                'class' => EditableColumn::className(),
                'attribute' => 'order',
                'url' => ['change-order'],
            ],
            //'search_index',
            //'status',

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
