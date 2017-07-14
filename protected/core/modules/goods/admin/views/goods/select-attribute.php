<?php

use core\modules\goods\models\GoodsAttribute;

/* @var $this yii\web\View */
/* @var $model core\modules\goods\models\Goods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-group">

    <?php foreach ($attributes as $v) { ?>

        <label class="control-label" for="attr_<?= $v['id'] ?>"><?= $v->attr_name ?></label>
        <?php if ($v->attr_input_type == GoodsAttribute::INPUT_TYPE_SELECT_LIST) { ?>
            <?php if ($v->attr_type == GoodsAttribute::ATTR_TYPE_SINGLE) { ?>
                <select class="form-control" name="attr_<?= $v['id'] ?>">
                    <?php foreach ($v['attr_values'] as $value) { ?>
                        <option value="<?= $value ?>"
                            <?php if (isset($values[$v->id]) && $values[$v->id] == $value) {
                                echo "selected";
                            } ?> >
                            <?= $value ?>
                        </option>
                    <?php } ?>
                </select>
            <?php } else if ($v->attr_type == GoodsAttribute::ATTR_TYPE_MULTIPLE) { ?>
                <div>
                    <?php foreach ($v['attr_values'] as $value) { ?>
                        <label>
                            <input type="checkbox" name="attr_<?= $v['id'] ?>[]" value="<?= $value ?>"
                                <?php if (isset($values[$v->id]) && in_array($value, $values[$v->id])) {
                                    echo "checked";
                                } ?>
                            >
                            <?= $value ?>
                        </label>
                    <?php } ?>
                </div>
            <?php } ?>
        <?php } else if ($v->attr_input_type == GoodsAttribute::INPUT_TYPE_TEXT) { ?>
            <div>
                <input class="form-control" type="text" name="attr_<?= $v['id'] ?>"
                       value="<?= isset($values[$v->id]) ? $values[$v->id] : '' ?>"/>
            </div>
        <?php } else if ($v->attr_input_type == GoodsAttribute::INPUT_TYPE_TEXT_AREA) { ?>
            <div>
                <textarea class="form-control" name="attr_<?= $v['id'] ?>"
                          rows="3"><?= isset($values[$v->id]) ? $values[$v->id] : '' ?></textarea>
            </div>
        <?php } ?>

    <?php } ?>

    <div class="help-block"></div>
</div>
