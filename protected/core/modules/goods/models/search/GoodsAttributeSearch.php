<?php
namespace core\modules\goods\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use core\modules\goods\models\GoodsAttribute;

/**
 * GoodsAttributeSearch represents the model behind the search form about `core\modules\goods\models\GoodsAttribute`.
 */
class GoodsAttributeSearch extends GoodsAttribute
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'attr_index', 'attr_type', 'attr_input_type', 'order', 'status'], 'integer'],
            [['attr_name', 'attr_values'], 'safe'],
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
        $query = GoodsAttribute::find();

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

        //Exclude the soft deleted recorders.
        $query->andFilterWhere(['<>', 'status', self::STATUS_DELETED]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'type_id' => $this->type_id,
            'attr_index' => $this->attr_index,
            'attr_type' => $this->attr_type,
            'attr_input_type' => $this->attr_input_type,
            'order' => $this->order,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'attr_name', $this->attr_name])
            ->andFilterWhere(['like', 'attr_values', $this->attr_values]);

        return $dataProvider;
    }
}
