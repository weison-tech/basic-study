<?php
namespace core\modules\goods\models;

use Yii;
use yii\helpers\ArrayHelper;
use core\modules\file\behaviors\UploadBehavior;
use core\modules\file\models\File;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%goods}}".
 *
 * @property integer $id
 * @property string $category_id
 * @property string $sn
 * @property string $name
 * @property string $short_name
 * @property string $brand_id
 * @property integer $stock
 * @property string $comment_counts
 * @property string $weight
 * @property string $market_price
 * @property string $price
 * @property string $cost_price
 * @property string $keywords
 * @property string $summary
 * @property string $description
 * @property string $original_img
 * @property integer $is_on_sale
 * @property integer $is_free_shipping
 * @property string $on_sale_at
 * @property integer $sort
 * @property integer $is_recommend
 * @property integer $is_new
 * @property integer $is_hot
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $goods_type
 * @property string $sales_sum
 */
class Goods extends \yii\db\ActiveRecord
{
    const ON_SALE = 1;

    const NOT_ON_SALE = 0;

    /**
     * @var string the original img input name
     */
    public $original_img;

    /**
     * @var string the images input name
     */
    public $images;

    /**
     * @var string store hot, new, recommend tags.
     */
    public $common_tags;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'category_id',
                    'name',
                    'short_name',
                    'brand_id',
                    'stock',
                    'weight',
                    'market_price',
                    'price',
                    'keywords',
                    'summary',
                ],
                'required'
            ],
            [
                [
                    'category_id',
                    'brand_id',
                    'stock',
                    'comment_counts',
                    'weight',
                    'is_on_sale',
                    'is_free_shipping',
                    'on_sale_at',
                    'sort',
                    'is_recommend',
                    'is_new',
                    'is_hot',
                    'updated_at',
                    'created_at',
                    'goods_type',
                    'sales_sum'
                ],
                'integer'
            ],
            [['market_price', 'price', 'cost_price'], 'number'],
            [['description'], 'string'],
            [['sn', 'short_name'], 'string', 'max' => 60],
            [['name'], 'string', 'max' => 120],
            [['keywords', 'summary'], 'string', 'max' => 255],
            [['original_img', 'images'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'images',
                'multiple' => true,
            ],
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'original_img',
            ],
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('GoodsModule.models_Goods', 'ID'),
            'category_id' => Yii::t('GoodsModule.models_Goods', 'Cat ID'),
            'sn' => Yii::t('GoodsModule.models_Goods', 'Sn'),
            'name' => Yii::t('GoodsModule.models_Goods', 'Name'),
            'short_name' => Yii::t('GoodsModule.models_Goods', 'Short Name'),
            'brand_id' => Yii::t('GoodsModule.models_Goods', 'Brand ID'),
            'stock' => Yii::t('GoodsModule.models_Goods', 'Stock'),
            'comment_counts' => Yii::t('GoodsModule.models_Goods', 'Comment Counts'),
            'weight' => Yii::t('GoodsModule.models_Goods', 'Weight'),
            'market_price' => Yii::t('GoodsModule.models_Goods', 'Market Price'),
            'price' => Yii::t('GoodsModule.models_Goods', 'Price'),
            'cost_price' => Yii::t('GoodsModule.models_Goods', 'Cost Price'),
            'keywords' => Yii::t('GoodsModule.models_Goods', 'Keywords'),
            'summary' => Yii::t('GoodsModule.models_Goods', 'Summary'),
            'description' => Yii::t('GoodsModule.models_Goods', 'Description'),
            'original_img' => Yii::t('GoodsModule.models_Goods', 'Original Img'),
            'is_on_sale' => Yii::t('GoodsModule.models_Goods', 'Is On Sale'),
            'is_free_shipping' => Yii::t('GoodsModule.models_Goods', 'Is Free Shipping'),
            'on_sale_at' => Yii::t('GoodsModule.models_Goods', 'On Sale At'),
            'sort' => Yii::t('GoodsModule.models_Goods', 'Sort'),
            'is_recommend' => Yii::t('GoodsModule.models_Goods', 'Is Recommend'),
            'is_new' => Yii::t('GoodsModule.models_Goods', 'Is New'),
            'is_hot' => Yii::t('GoodsModule.models_Goods', 'Is Hot'),
            'updated_at' => Yii::t('GoodsModule.models_Goods', 'Last Update'),
            'goods_type' => Yii::t('GoodsModule.models_Goods', 'Goods Type'),
            'sales_sum' => Yii::t('GoodsModule.models_Goods', 'Sales Sum'),
            'original_img_input' => Yii::t('GoodsModule.models_Goods', 'Original Img'),
            'images' => Yii::t('GoodsModule.models_Goods', 'Album Images'),
            'common_tags' => Yii::t('GoodsModule.models_Goods', 'Tags'),
        ];
    }

    /**
     * Change the null value to be corresponding default value.
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($this->original_img == null) {
            $this->original_img = '';
        }

        if ($this->sn == null) {
            $this->sn = $this->generateSn();
        }

        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function getImg()
    {
        return $this->hasOne(File::className(), ['object_id' => 'id'])
            ->onCondition(['object_model' => self::className(), 'object_field' => 'original_img']);
    }

    /**
     * @inheritdoc
     */
    public function getType()
    {
        return $this->hasOne(GoodsType::className(), ['id' => 'goods_type']);
    }

    /**
     * @inheritdoc
     */
    public function getCategory()
    {
        return $this->hasOne(GoodsCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @inheritdoc
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }

    /**
     * @inheritdoc
     */
    public function getAlbum()
    {
        return $this->hasMany(File::className(), ['object_id' => 'id'])
            ->onCondition(['object_model' => self::className(), 'object_field' => 'images']);
    }


    /**
     * Get sale status.
     * @param bool $flag
     * @return array|mixed
     */
    public static function getSaleStatus($flag = false)
    {
        $data = [
            self::ON_SALE => Yii::t('GoodsModule.models_Goods', 'On Sale'),
            self::NOT_ON_SALE => Yii::t('GoodsModule.models_Goods', 'Not On Sale'),
        ];
        return $flag === false ? $data : $data[$flag];
    }

    /**
     * Get common tags.
     * @return array
     */
    public static function getCommonTags()
    {
        return [
            'is_new' => Yii::t('GoodsModule.models_Goods', 'New'),
            'is_hot' => Yii::t('GoodsModule.models_Goods', 'Hot'),
            'is_recommend' => Yii::t('GoodsModule.models_Goods', 'Recommend'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function getSelect($flag = false)
    {
        $data = [
            0 => Yii::t('GoodsModule.base', 'No'),
            1 => Yii::t('GoodsModule.base', 'Yes'),
        ];
        return $flag === false ? $data : $data[$flag];
    }

    /**
     * Get goods specification's cartesian product
     * @param int $goods_id goods id
     * @param array $spec_arr key is specification name, value is specification value
     * eg.  Array ( [1] => Array ( [0] => 1 ) [2] => Array ( [0] => 5 ) )
     * @return string the goods specification stock price item.
     */
    public static function getSpecInput($goods_id = 0, $spec_arr)
    {
        //Sort array, let less element array in front.
        uasort($spec_arr, function ($a, $b) {
            return count($a) > count($b);
        });

        //Spec name ids.
        $clo_name = array_keys($spec_arr);

        //Get the cartesian product data.
        $spec_arr2 = self::getCartesianProduct($spec_arr);

        //Find all specification names
        $spec = SpecName::find()->select(['id', 'name'])->asArray()->all();
        //Convert array to 'id' => 'name' pairs format.
        if ($spec) {
            $spec = ArrayHelper::map($spec, 'id', 'name');
        }

        //Find the specification values
        $specItem = SpecValue::find()->select('id, value, spec_id')->asArray()->all();
        //Reindex the array by 'id' column.
        if ($specItem) {
            $specItem = ArrayHelper::index($specItem, 'id');
        }

        //Find the goods specification price, stock ...
        $keySpecGoodsPrice = GoodsSpec::find()->where(['goods_id' => $goods_id])
            ->select('key, key_name, price, stock')->asArray()->all();
        //Reindex the array by 'key' field.
        if ($keySpecGoodsPrice) {
            $keySpecGoodsPrice = ArrayHelper::index($keySpecGoodsPrice, 'key');
        }

        $str = "<table class='table table-bordered' id='spec_input_tab'>";

        $str .= "<tr>";
        //Add the specification name to table column.
        foreach ($clo_name as $k => $v) {
            $str .= "<td><b>{$spec[$v]}</b></td>";
        }
        $str .= "<td><b>" . Yii::t('GoodsModule.models_Goods', 'Price') . "</b></td>";
        $str .= "<td><b>" . Yii::t('GoodsModule.models_Goods', 'Stock') . "</b></td>";
        $str .= "</tr>";

        foreach ($spec_arr2 as $k => $v) {
            $str .= "<tr>";
            $item_key_name = array();
            foreach ($v as $k2 => $v2) {
                $str .= "<td>{$specItem[$v2]['value']}</td>";
                $item_key_name[$v2] = $spec[$specItem[$v2]['spec_id']] . ':' . $specItem[$v2]['value'];
            }
            ksort($item_key_name);
            $item_key = implode(',', array_keys($item_key_name));
            $item_name = implode(' ', $item_key_name);

            $price = isset($keySpecGoodsPrice[$item_key]) ? $keySpecGoodsPrice[$item_key]['price'] : 0;
            $stock = isset($keySpecGoodsPrice[$item_key]) ? $keySpecGoodsPrice[$item_key]['stock'] : 0;
            $str .= "<td><input name='item[$item_key][price]' value='{$price}' onkeyup='this.value=this.value.replace(/[^\d.]/g,\"\")' onpaste='this.value=this.value.replace(/[^\d.]/g,\"\")' /></td>";
            $str .= "<td><input name='item[$item_key][stock]' value='{$stock}' onkeyup='this.value=this.value.replace(/[^\d.]/g,\"\")' onpaste='this.value=this.value.replace(/[^\d.]/g,\"\")'/></td>";
            $str .= "<input type='hidden' name='item[$item_key][key_name]' value='$item_name' /></td>";
            $str .= "</tr>";
        }
        $str .= "</table>";
        return $str;
    }

    /**
     * @return array
     */
    private static function getCartesianProduct()
    {
        $data = func_get_args();
        $data = current($data);
        $result = array();
        $arr1 = array_shift($data);
        foreach ($arr1 as $key => $item) {
            $result[] = array($item);
        }

        foreach ($data as $key => $item) {
            $result = self::combineArray($result, $item);
        }
        return $result;
    }

    /**
     * Get two array cartesian product.
     * @param array $arr1
     * @param array $arr2
     * @return array the cartesian product result.
     */
    private static function combineArray($arr1, $arr2)
    {
        $result = array();
        foreach ($arr1 as $item1) {
            foreach ($arr2 as $item2) {
                $temp = $item1;
                $temp[] = $item2;
                $result[] = $temp;
            }
        }
        return $result;
    }

    /**
     * Generate goods sn NO.
     */
    private function generateSn()
    {
        return 'YS' . Date('YmdHis') . rand(1000, 9999);
    }
}
