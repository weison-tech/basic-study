<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\modules\goods\models\SpecName */

$this->title = Yii::t('GoodsModule.base', 'Update Spec Name: ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('GoodsModule.base', 'Spec Names'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('GoodsModule.base', 'Update');
?>
<div class="spec-name-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
