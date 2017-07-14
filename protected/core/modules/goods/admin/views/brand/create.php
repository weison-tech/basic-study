<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\modules\goods\models\Brand */

$this->title = Yii::t('GoodsModule.base', 'Create Brand');
$this->params['breadcrumbs'][] = ['label' => Yii::t('GoodsModule.base', 'Brands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
