<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use core\modules\goods\models\GoodsCategory as Category;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model core\modules\goods\models\search\BrandSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brand-search">

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

    <?= $form->field($model, 'name')->textInput(array('placeholder' => Yii::t('GoodsModule.models_brand', 'Name'))) ?>

    <?= $form->field($model, 'description')->textInput(array(
        'placeholder' => Yii::t('GoodsModule.models_brand', 'Description')
    )) ?>

    <?= $form->field($model, 'url')->textInput(array('placeholder' => Yii::t('GoodsModule.models_brand', 'Url'))) ?>

    <?= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map(
            Category::get(
                0,
                Category::find()->where(['status'=>Category::STATUS_ENABLED])->asArray()->all()
            ), 'id', 'label'
        ),
        ['class' => 'form-control', 'prompt' => Yii::t('GoodsModule.base', 'Please Filter')]
    ) ?>

    <?= $form->field($model, 'status')->dropDownList($model::getStatus(), ['prompt' => Yii::t('GoodsModule.base', 'Please Filter')]) ?>

    <div class="form-group form-actions">
        <?= Html::submitButton(Yii::t('GoodsModule.base', 'Search'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
