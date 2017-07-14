<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\modules\goods\models\Goods */

$this->title = Yii::t('GoodsModule.base', 'Update Goods: ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('GoodsModule.base', 'Goods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('GoodsModule.base', 'Update');
?>
<div class="goods-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
