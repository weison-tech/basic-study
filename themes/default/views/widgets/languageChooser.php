<?php
use yii\widgets\ActiveForm;
?>
<div class="text text-center animated fadeIn">
    <?php if (count($languages) > 1) : ?>
        <?= Yii::t('base', "Choose language:"); ?>
        <div class="langSwitcher inline-block">
            <?php $form = ActiveForm::begin(['id' => 'choose-language-form']); ?>

            <?= $form->field($model, 'language')->dropDownList($languages,['onChange' => 'this.form.submit()']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    <?php endif; ?>
</div>