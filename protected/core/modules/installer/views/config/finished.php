<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="panel panel-default animated fadeIn">

    <div class="panel-body text-center">
        <br>
        <p class="lead"><?php echo Yii::t('InstallerModule.views_config_finished', '<strong>Congratulations</strong>. You\'re done.'); ?></p>

        <p><?php echo Yii::t('InstallerModule.views_config_finished', 'Now you can click below link to view frontend or backend pages.'); ?></p>

        <div class="text-center">
            <br>
            <?php echo Html::a(Yii::t('InstallerModule.views_config_finished', 'Go to frontend'), Url::home(), array('class' => 'btn btn-primary', 'data-ui-loader' => '')); ?>
            <?php echo Html::a(Yii::t('InstallerModule.views_config_finished', 'Go to Backend'), Url::to(['/admin/index/login']), array('class' => 'btn btn-info', 'data-ui-loader' => '', 'style' => 'margin-left:20px;')); ?>
            <br><br>
        </div>
    </div>
</div>
