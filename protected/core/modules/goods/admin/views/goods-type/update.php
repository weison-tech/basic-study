<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\modules\goods\models\GoodsType */

$this->title = Yii::t('GoodsModule.base', 'Update Goods Type: ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('GoodsModule.base', 'Goods Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('GoodsModule.base', 'Update');
?>
<div class="goods-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
