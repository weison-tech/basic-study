<?php

use yii\helpers\Html;
use core\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title><?php echo Html::encode($this->title); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="language" content="en"/>
        <?= Html::csrfMetaTags() ?>

        <?php $this->head() ?>

        <!-- start: render additional head (css and js files) -->
        <?php echo $this->render('@shop/modules/home/views/layouts/head'); ?>
        <!-- end: render additional head -->
    </head>
    <body>
    <?php $this->beginBody() ?>

    <div class="container installer" style="margin: 0 auto; max-width: 700px;">
        <?php echo $content; ?>

        <div class="text text-center powered">
            Powered by <a href="http://www.itweshare.com" target="_blank">weison-tech</a>
            <br/><br/>
        </div>
    </div>

    <div class="clear"></div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>