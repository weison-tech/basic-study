<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use core\modules\goods\models\GoodsType;

/* @var $this yii\web\View */
/* @var $model core\modules\goods\models\SpecName */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="spec-name-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type_id')->dropDownList(
        ArrayHelper::map(
            GoodsType::find()->where(['status' => GoodsType::STATUS_ENABLED])->all(), 'id', 'name'
        ),
        ['class' => 'form-control', 'prompt' => Yii::t('GoodsModule.base', 'Please Filter')]
    ) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value_items')->textInput(['maxlength' => true])
        ->textarea(['rows' => '6', 'placeholder' => Yii::t('GoodsModule.base', 'One line one item.')]) ?>

    <?= $form->field($model, 'order')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('GoodsModule.base', 'Create') : Yii::t('GoodsModule.base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
