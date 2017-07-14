<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use core\modules\goods\models\GoodsType;

/* @var $this yii\web\View */
/* @var $model core\modules\goods\models\search\GoodsAttributeSearch */
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

    <?= $form->field($model, 'type_id')->dropDownList(
        ArrayHelper::map(
            GoodsType::find()->where(['status' => GoodsType::STATUS_ENABLED])->all(), 'id', 'name'
        ),
        ['class' => 'form-control', 'prompt' => Yii::t('GoodsModule.base', 'Please Filter')]
    ) ?>

    <?= $form->field($model, 'attr_name')->textInput(array(
        'placeholder' => Yii::t('GoodsModule.models_GoodsAttribute', 'Attr Name')
    )) ?>

    <div class="form-group form-actions">
        <?= Html::submitButton(Yii::t('GoodsModule.base', 'Search'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
