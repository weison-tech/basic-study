<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\modules\goods\models\SpecName */

$this->title = Yii::t('GoodsModule.base', 'Create Spec Name');
$this->params['breadcrumbs'][] = ['label' => Yii::t('GoodsModule.base', 'Spec Names'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spec-name-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
