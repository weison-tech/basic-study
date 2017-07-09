<?php

use core\compat\CActiveForm;
use yii\helpers\Html;

$this->pageTitle = Yii::t('InstallerModule.views_config_admin', 'Admin User Configuration');

?>

<div id="admin-form" class="panel panel-default animated fadeIn">
    <div class="panel-heading">
        <?php echo Yii::t('InstallerModule.views_config_admin', '<strong>Admin User</strong> Configuration'); ?>
    </div>

    <div class="panel-body">
        <p>
            <?php echo Yii::t('InstallerModule.views_config_admin', 'Below will create one admin user, you can use this user to manage your shopping platform.'); ?>
        </p>

        <?php $form = CActiveForm::begin(); ?>

        <hr/>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'username'); ?>
            <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'id' => 'username', 'placeholder' => Yii::t('InstallerModule.views_config_admin', 'Username'))); ?>
            <?php echo $form->error($model, 'username', ['style' => 'color:#ff8989']); ?>
        </div>
        <hr/>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'email'); ?>
            <?php echo $form->textField($model, 'email', array('class' => 'form-control', 'placeholder' => Yii::t('InstallerModule.views_config_admin', 'Email'))); ?>
            <?php echo $form->error($model, 'email', ['style' => 'color:#ff8989']); ?>
        </div>
        <hr />
        <div class="form-group">
            <?php echo $form->labelEx($model, 'password'); ?>
            <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => Yii::t('InstallerModule.views_config_admin', 'Password'))); ?>
            <?php echo $form->error($model, 'password', ['style' => 'color:#ff8989']); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'confirmPassword'); ?>
            <?php echo $form->passwordField($model, 'confirmPassword', array('class' => 'form-control', 'placeholder' => Yii::t('InstallerModule.views_config_admin', 'Confirm Password'))); ?>
            <?php echo $form->error($model, 'confirmPassword', ['style' => 'color:#ff8989']); ?>
        </div>

        <hr>

        <?php echo Html::submitButton(Yii::t('InstallerModule.views_setup_database', 'Next') . ' <i class="fa fa-arrow-circle-right"></i>', array('class' => 'btn btn-primary', 'data-loader' => "modal", 'data-message' => Yii::t('InstallerModule.views_setup_database', 'Set administrator account...'))); ?>

        <?php CActiveForm::end(); ?>
    </div>
</div>

<script type="text/javascript">

    $(function () {
        // set cursor to email field
        $('#username').focus();
    })

    // Shake panel after wrong validation
    <?php if ($model->hasErrors()) { ?>
        $('#admin-form').removeClass('fadeIn');
        $('#admin-form').addClass('shake');
    <?php } ?>

</script>