<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\modules\goods\models\Brand */

$this->title = Yii::t('GoodsModule.base', 'Update Brand') . ':' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('GoodsModule.base', 'Brands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('GoodsModule.base', 'Update');
?>
<div class="brand-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
