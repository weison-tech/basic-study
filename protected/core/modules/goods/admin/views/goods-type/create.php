<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\modules\goods\models\GoodsType */

$this->title = Yii::t('GoodsModule.base', 'Create Goods Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('GoodsModule.base', 'Goods Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
