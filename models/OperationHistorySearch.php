<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OperationHistory;

/**
 * OperationHistorySearch represents the model behind the search form about `app\models\OperationHistory`.
 */
class OperationHistorySearch extends OperationHistory
{
    public $userName;
    public $customerName;
    public $keyRoom;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'customer_id', 'key_id', 'type'], 'integer'],
            [['date', 'userName', 'customerName', 'keyRoom'], 'safe'],
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
        $query = OperationHistory::find();

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

        $query->joinWith('customer');
        $query->joinWith('user');
        $query->joinWith('key');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'customer_id' => $this->customer_id,
            'date' => $this->date,
            'key_id' => $this->key_id,
            'type' => $this->type,
        ])
            ->andFilterWhere(['like', 'user.name', $this->userName])
            ->andFilterWhere(['like', 'customer.name', $this->customerName])
            ->andFilterWhere(['like', 'key.room', $this->keyRoom]);

        return $dataProvider;
    }
}
