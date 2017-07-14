<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\modules\goods\models\Goods */

$this->title = Yii::t('GoodsModule.base', 'Create Goods');
$this->params['breadcrumbs'][] = ['label' => Yii::t('GoodsModule.base', 'Goods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
