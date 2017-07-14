<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use core\modules\goods\models\Brand;
use core\modules\goods\models\GoodsCategory as Category;

/* @var $this yii\web\View */
/* @var $model core\modules\goods\models\search\GoodsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'form-inline',
            'style' => 'margin:10px;',
        ],
        'fieldConfig' => [
            'template' => "{label}: {input}",
            'inputOptions' => [
                'class' => 'form-control',
                'style' => 'margin-right:8px;',
            ],
        ]
    ]); ?>

    <?= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map(
            Category::get(
                0,
                Category::find()->where(['status'=>Category::STATUS_ENABLED])->asArray()->all()
            ), 'id', 'label'
        ),
        ['class' => 'form-control', 'prompt' => Yii::t('GoodsModule.base', 'Please Filter')]
    ) ?>

    <?= $form->field($model, 'brand_id')->dropDownList(
        ArrayHelper::map(
            Brand::find()->where(['status' => Brand::STATUS_ENABLED])->all(), 'id', 'name'
        ),
        ['class' => 'form-control', 'prompt' => Yii::t('GoodsModule.base', 'Please Filter')]
    ) ?>

    <?= $form->field($model, 'is_on_sale')->dropDownList(
        $model::getSaleStatus(),
        ['class' => 'form-control', 'prompt' => Yii::t('GoodsModule.base', 'Please Filter')]
    ) ?>

    <?= $form->field($model, 'common_tags')->dropDownList(
        $model::getCommonTags(),
        ['class' => 'form-control', 'prompt' => Yii::t('GoodsModule.base', 'Please Filter')]
    ) ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'brand_id') ?>

    <?php // echo $form->field($model, 'stock') ?>

    <?php // echo $form->field($model, 'comment_counts') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'market_price') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'cost_price') ?>

    <?php // echo $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'summary') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'original_img') ?>

    <?php // echo $form->field($model, 'is_on_sale') ?>

    <?php // echo $form->field($model, 'is_free_shipping') ?>

    <?php // echo $form->field($model, 'on_sale_at') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <?php // echo $form->field($model, 'is_recommend') ?>

    <?php // echo $form->field($model, 'is_new') ?>

    <?php // echo $form->field($model, 'is_hot') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'goods_type') ?>

    <?php // echo $form->field($model, 'sales_sum') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('GoodsModule.base', 'Search'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
