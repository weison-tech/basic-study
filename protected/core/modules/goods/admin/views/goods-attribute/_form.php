<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use core\modules\goods\models\GoodsType;

/* @var $this yii\web\View */
/* @var $model core\modules\goods\models\GoodsAttribute */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-attribute-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'attr_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_id')->dropDownList(
        ArrayHelper::map(
            GoodsType::find()->where(['status' => GoodsType::STATUS_ENABLED])->all(), 'id', 'name'
        ),
        ['class' => 'form-control', 'prompt' => Yii::t('GoodsModule.base', 'Please Filter')]
    ) ?>

    <?= $form->field($model, 'attr_input_type')->radioList($model::getInputType(), ['onChange' => 'set()']) ?>

    <?= $form->field($model, 'attr_type')->radioList($model::getAttributeType()) ?>

    <?= $form->field($model, 'attr_values')->textarea([
        'rows' => 6,
        'placeholder' => Yii::t('GoodsModule.base', 'One line one attribute item.')]
    ) ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('GoodsModule.base', 'Create') : Yii::t('GoodsModule.base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">

    $(function(){
        set();
    })

    function set()
    {
        var input_type = $("input[name='GoodsAttribute[attr_input_type]']:checked").val();
        if (input_type != <?=$model::INPUT_TYPE_SELECT_LIST?>) {
            $(".field-goodsattribute-attr_type").hide();
            $(".field-goodsattribute-attr_values").hide();
        } else {
            $(".field-goodsattribute-attr_type").show();
            $(".field-goodsattribute-attr_values").show();
        }
    }
</script>
