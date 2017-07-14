<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model core\modules\goods\models\GoodsType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'allowed_extensions')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'max_file_size')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('GoodsModule.base', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
