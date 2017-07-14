    <?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\modules\goods\models\GoodsCategory */

$this->title = Yii::t('GoodsModule.views_goods_category_index', 'Create Goods Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('GoodsModule.views_goods_category_index', 'Goods Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
