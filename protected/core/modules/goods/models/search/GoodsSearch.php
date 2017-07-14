<?php
namespace core\modules\goods\models\search;

use yii\data\Pagination;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use core\modules\goods\models\Goods;

/**
 * GoodsSearch represents the model behind the search form about `core\modules\goods\models\Goods`.
 */
class GoodsSearch extends Goods
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'brand_id', 'stock', 'comment_counts', 'weight', 'is_on_sale', 'is_free_shipping', 'on_sale_at', 'sort', 'is_recommend', 'is_new', 'is_hot', 'updated_at', 'goods_type', 'sales_sum'], 'integer'],
            [['sn', 'name', 'short_name', 'keywords', 'summary', 'description', 'original_img'], 'safe'],
            [['market_price', 'price', 'cost_price'], 'number'],
            [['common_tags'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Goods::find();

        $query->joinWith('img');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'stock' => $this->stock,
            'comment_counts' => $this->comment_counts,
            'weight' => $this->weight,
            'market_price' => $this->market_price,
            'price' => $this->price,
            'cost_price' => $this->cost_price,
            'is_on_sale' => $this->is_on_sale,
            'is_free_shipping' => $this->is_free_shipping,
            'on_sale_at' => $this->on_sale_at,
            'sort' => $this->sort,
            'is_recommend' => $this->is_recommend,
            'is_new' => $this->is_new,
            'is_hot' => $this->is_hot,
            'updated_at' => $this->updated_at,
            'goods_type' => $this->goods_type,
            'sales_sum' => $this->sales_sum,
        ]);

        if ($this->common_tags) {
            $query->andFilterWhere([$this->common_tags => 1]);
        }

        $query->andFilterWhere(['like', 'sn', $this->sn])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'short_name', $this->short_name])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'original_img', $this->original_img]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchTag($tag)
    {
        $query = Goods::find();

        $query->joinWith('img');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->andFilterWhere([$tag => 1, 'is_on_sale' => self::ON_SALE]);

        $count = $query->count();

        // create a pagination object with the total count
        $pagination = new Pagination(['totalCount' => $count, 'defaultPageSize' => 4]);

        // limit the query using the pagination and retrieve the articles
        $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $dataProvider;
    }
}
