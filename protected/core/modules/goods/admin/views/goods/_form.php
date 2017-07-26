<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use core\modules\goods\models\GoodsCategory as Category;
use core\modules\goods\models\Brand;
use core\modules\goods\models\GoodsType;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model core\modules\goods\models\Goods */
/* @var $form yii\widgets\ActiveForm */
?>

<div>

    <div class="goods-form">

        <?php $form = ActiveForm::begin(); ?>

        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#basic" data-toggle="tab" aria-expanded="false">
                    <?= Yii::t('GoodsModule.views_goods_form', 'Basic') ?>
                </a>
            </li>
            <li class="">
                <a href="#description" data-toggle="tab" aria-expanded="false">
                    <?= Yii::t('GoodsModule.views_goods_form', 'Description') ?>
                </a>
            </li>
            <li class="">
                <a href="#album" data-toggle="tab" aria-expanded="true">
                    <?= Yii::t('GoodsModule.views_goods_form', 'Album') ?>
                </a>
            </li>
            <li class="">
                <a href="#specification" data-toggle="tab" aria-expanded="false">
                    <?= Yii::t('GoodsModule.views_goods_form', 'Specification') ?>
                </a>
            </li>

            <li class="">
                <a href="#attribute" data-toggle="tab" aria-expanded="false">
                    <?= Yii::t('GoodsModule.views_goods_form', 'Attribute') ?>
                </a>
            </li>
        </ul>

        <br/>

        <div class="tab-content">
            <div class="tab-pane active" id="basic">

                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <?= $form->field($model, 'category_id')->dropDownList(
                            ArrayHelper::map(
                                Category::get(
                                    0,
                                    Category::find()->where(['status'=>Category::STATUS_ENABLED])->asArray()->all()
                                ), 'id', 'label'
                            ),
                            ['class' => 'form-control', 'prompt' => Yii::t('GoodsModule.base', 'Please Filter')]
                        ) ?>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <?= $form->field($model, 'short_name')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <?= $form->field($model, 'sn')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <?= $form->field($model, 'market_price')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <?= $form->field($model, 'cost_price')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <?= $form->field($model, 'stock')->textInput() ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <?= $form->field($model, 'brand_id')->dropDownList(
                            ArrayHelper::map(
                                Brand::find()->where(['status' => Brand::STATUS_ENABLED])->all(), 'id', 'name'
                            ),
                            ['class' => 'form-control', 'prompt' => Yii::t('GoodsModule.base', 'Please Filter')]
                        ) ?>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <?= $form->field($model, 'is_free_shipping')->dropDownList($model::getSelect()) ?>
                    </div>
                </div>

                <?= $form->field($model, 'original_img')->widget('core\modules\file\widgets\Upload',
                    [
                        'url' => ['/file/file/upload'],
                        'maxFileSize' => 10 * 1024 * 1024, // 10 MiB,
                        'minFileSize' => 1,
                        'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
                    ]
                ); ?>

                <?= $form->field($model, 'summary')->textarea(['rows' => 3]) ?>

                <input id="goods_id" type="hidden" value="<?=$model->isNewRecord ? 0 : $model->id ?>" />

            </div>

            <div class="tab-pane" id="description">
                <?= $form->field($model, 'description')->widget('kucha\ueditor\UEditor',[]) ?>
            </div>

            <div class="tab-pane" id="album">
                <?= $form->field($model, 'images')->widget(
                    'core\modules\file\widgets\Upload',
                    [
                        'url' => ['/file/file/upload'],
                        'sortable' => true,
                        'maxFileSize' => 10 * 1024 * 1024, // 10 MiB
                        'maxNumberOfFiles' => '10',
                    ]
                ) ?>
            </div>

            <div class="tab-pane" id="specification">
                <?= $form->field($model, 'goods_type')->dropDownList(
                    ArrayHelper::map(
                        GoodsType::find()->where(['status' => GoodsType::STATUS_ENABLED])->all(), 'id', 'name'
                    ),
                    [
                        'class' => 'form-control',
                        'prompt' => Yii::t('GoodsModule.base', 'Please Filter'),
                        'onChange' => 'select_spec(this.value)',
                    ]
                ) ?>
                <div id="specification-ajax-return"></div>
            </div>

            <div class="tab-pane" id="attribute">
                <?= $form->field($model, 'goods_type')->dropDownList(
                    ArrayHelper::map(
                        GoodsType::find()->where(['status' => GoodsType::STATUS_ENABLED])->all(), 'id', 'name'
                    ),
                    [
                        'class' => 'form-control',
                        'prompt' => Yii::t('GoodsModule.base', 'Please Filter'),
                        'onChange' => 'select_attr(this.value)',
                    ]
                ) ?>
                <div id="attribute-ajax-return"></div>
            </div>

        </div>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('GoodsModule.base', 'Create') : Yii::t('GoodsModule.base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

<script>
    $(function(){
        var goods_type = $('#attribute').find("option:selected").val();
        if (goods_type) {
            select_attr(goods_type);
            select_spec(goods_type);
        }
    });

    /**
     * Ajax get goods attribute form
     * @param value
     */
    function select_attr(value)
    {
        var url = "<?= Url::to(['select-attribute']) ?>";
        var goods_id = <?= $model->isNewRecord ? 0 : $model->id ?>;
        var _csrf = "<?= Yii::$app->request->csrfToken ?>";
        $.post(url, {goods_type: value, goods_id: goods_id, _csrf: _csrf}, function(data){
            $("#attribute-ajax-return").html(data);
        })
    }

    /**
     * Ajax get goods specification form
     * @param value
     */
    function select_spec(value)
    {
        var url = "<?= Url::to(['select-specification']) ?>";
        var goods_id = <?= $model->isNewRecord ? 0 : $model->id ?>;
        var _csrf = "<?= Yii::$app->request->csrfToken ?>";
        $.post(url, {goods_type: value, goods_id: goods_id, _csrf: _csrf}, function(data){
            $("#specification-ajax-return").html(data);
        })
    }
</script>



