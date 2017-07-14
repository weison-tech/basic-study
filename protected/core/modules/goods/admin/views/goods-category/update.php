<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\modules\goods\models\GoodsCategory */

$this->title = Yii::t('GoodsModule.base', 'Update Goods Category: ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('GoodsModule.views_goods_category_index', 'Goods Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('GoodsModule.base', 'Update');
?>
<div class="goods-category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
