<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\modules\goods\models\GoodsAttribute */

$this->title = Yii::t('GoodsModule.base', 'Create Goods Attribute');
$this->params['breadcrumbs'][] = ['label' => Yii::t('GoodsModule.base', 'Goods Attributes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-attribute-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
