<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\modules\goods\models\GoodsAttribute */

$this->title = Yii::t('GoodsModule.base', 'Update Goods Attribute: ') . $model->attr_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('GoodsModule.base', 'Goods Attributes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('GoodsModule.base', 'Update');
?>
<div class="goods-attribute-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
