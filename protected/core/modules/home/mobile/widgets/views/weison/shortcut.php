<?php
    use yii\helpers\Url;
?>

<div class="index-column bBor">

<?php foreach ($items as $item) { ?>
    <a class="index-column-item" href="<?= Url::toRoute($item['url']) ?>">
        <i><img src="<?= $item['icon'] ?>"></i>
        <p><?= $item['label'] ?></p>
    </a>
<?php } ?>

</div>