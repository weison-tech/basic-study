<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('InstallerModule.views_index_index', 'Install');
?>

<div class="panel panel-default animated fadeIn">

    <div class="panel-body text-center">
        <br><br>

        <p class="lead">
            <?php echo Yii::t(
                'InstallerModule.views_index_index',
                '<strong>Welcome</strong> to use Yii-Shop to build your own shopping platform'
            ); ?>
        </p>

        <p>
            <?php echo Yii::t(
                'InstallerModule.views_index_index',
                'This wizard will install and configure your own shopping platform.<br><br>To continue, click Next.'
            ); ?>
        </p>

        <br><hr><br>

        <?php echo Html::a(Yii::t('InstallerModule.views_index_index', "Next") .
            ' <i class="fa fa-arrow-circle-right"></i>',
            Url::to(['go']),
            array('class' => 'btn btn-lg btn-primary')
        ); ?>

        <br><br>

    </div>

</div>

<?php echo core\widgets\LanguageChooser::widget(); ?>
