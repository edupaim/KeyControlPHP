<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Key;

/**
 * KeySearch represents the model behind the search form about `app\models\Key`.
 */
class KeySearch extends Key
{
    public $customerName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'room_type', 'customer_id'], 'integer'],
            [['room', 'capacity', 'customerName'], 'safe'],
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
        $query = Key::find();

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
            'room_type' => $this->room_type,
            'customer_id' => $this->customer_id,
        ]);

        $query->joinWith('customer');

        $query->andFilterWhere(['like', 'room', $this->room])
            ->andFilterWhere(['like', 'capacity', $this->capacity])
            ->andFilterWhere(['like', 'customer.name', $this->customerName]);

        return $dataProvider;
    }
}
