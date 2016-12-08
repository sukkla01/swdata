<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FoodDetail01;

/**
 * FoodDetail01Search represents the model behind the search form of `app\models\FoodDetail01`.
 */
class FoodDetail01Search extends FoodDetail01
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['foodid'], 'integer'],
            [['fooddate', 'foodtime', 'an', 'hn', 'meal', 'ward', 'icode', 'Congenital_disease', 'comment', 'fooddate_rec', 'staff', 'bd', 'cal'], 'safe'],
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
        $query = FoodDetail01::find();

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
            'foodid' => $this->foodid,
            'fooddate' => $this->fooddate,
            'foodtime' => $this->foodtime,
        ]);

        $query->andFilterWhere(['like', 'an', $this->an])
            ->andFilterWhere(['like', 'hn', $this->hn])
            ->andFilterWhere(['like', 'meal', $this->meal])
            ->andFilterWhere(['like', 'ward', $this->ward])
            ->andFilterWhere(['like', 'icode', $this->icode])
            ->andFilterWhere(['like', 'Congenital_disease', $this->Congenital_disease])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'fooddate_rec', $this->fooddate_rec])
            ->andFilterWhere(['like', 'staff', $this->staff])
            ->andFilterWhere(['like', 'bd', $this->bd])
            ->andFilterWhere(['like', 'cal', $this->cal]);

        return $dataProvider;
    }
}
