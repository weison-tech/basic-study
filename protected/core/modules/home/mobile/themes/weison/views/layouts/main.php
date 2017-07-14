<?php
use yii\helpers\Html;
use core\modules\home\mobile\widgets\BottomNav;

\core\modules\home\mobile\themes\weison\assets\CommonAsset::register($this);
?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />

        <title><?php echo Html::encode($this->title); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="language" content="en"/>
        <?= Html::csrfMetaTags() ?>

        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
        <?php echo $content; ?>
        <!-- nav start -->
        <nav class="foot_nav-warp">
            <div class="foot_nav">
                <?= BottomNav::widget() ?>
            </div>
        </nav>
        <!-- nav end -->
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>