<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div id="name-form" class="panel panel-default">

    <div class="panel-heading">
        <?php echo Yii::t('InstallerModule.views_config_basic', 'Social Network <strong>Name</strong>'); ?>
    </div>

    <div class="panel-body">

        <p><?php echo Yii::t('InstallerModule.views_config_basic', 'Of course, your new social network needs a name. Please change the default name with one you like. (For example the name of your company, organization or club)'); ?></p>


        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

        <hr>

        <?php echo Html::submitButton(Yii::t('InstallerModule.views_config_basic', 'Next'), array('class' => 'btn btn-primary', 'data-ui-loader' => '')); ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>
