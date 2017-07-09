<?php

use yii\helpers\Html;
use core\modules\installer\widgets\PrerequisitesList;

$this->pageTitle = Yii::t('InstallerModule.views_setup_prerequisites', 'Requirements Check');
?>
<div class="panel panel-default animated fadeIn">

    <div class="panel-heading">
        <?php echo Yii::t('InstallerModule.views_setup_prerequisites', '<strong>System</strong> Check'); ?>
    </div>

    <div class="panel-body">
        <p><?php echo Yii::t('InstallerModule.views_setup_prerequisites', 'This overview shows all system requirements of Shop.'); ?></p>

        <hr/>

        <?= PrerequisitesList::widget(); ?>

        <?php if (!$hasError): ?>
            <div class="alert alert-success">
                <?php echo Yii::t('InstallerModule.views_setup_prerequisites', 'Congratulations! Everything is ok and ready to start over!'); ?>
            </div>
        <?php endif; ?>

        <hr>

        <?php echo Html::a('<i class="fa fa-repeat"></i> ' . Yii::t('InstallerModule.views_setup_prerequisites', 'Check again'), array('/installer/setup/prerequisites'), array('class' => 'btn btn-info')); ?>

        <?php if (!$hasError): ?>
            <?php echo Html::a(Yii::t('InstallerModule.views_setup_prerequisites', 'Next') . ' <i class="fa fa-arrow-circle-right"></i>', array('/installer/setup/database'), array('class' => 'btn btn-primary', 'style' => 'margin-left:20px;')); ?>
        <?php endif; ?>

    </div>
</div>