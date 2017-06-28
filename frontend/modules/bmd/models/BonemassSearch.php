<?php

namespace app\modules\bmd\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\bmd\models\Bonemass;

/**
 * BonemassSearch represents the model behind the search form of `app\modules\bmd\models\Bonemass`.
 */
class BonemassSearch extends Bonemass
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['hn', 'vstdate', 'vn', 'l1l4', 'neck_lt', 'neck_rt', 'troch_lt', 'troch_rt', 'create_date'], 'safe'],
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
        $query = Bonemass::find();

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
            'vstdate' => $this->vstdate,
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'hn', $this->hn])
            ->andFilterWhere(['like', 'vn', $this->vn])
            ->andFilterWhere(['like', 'l1l4', $this->l1l4])
            ->andFilterWhere(['like', 'neck_lt', $this->neck_lt])
            ->andFilterWhere(['like', 'neck_rt', $this->neck_rt])
            ->andFilterWhere(['like', 'troch_lt', $this->troch_lt])
            ->andFilterWhere(['like', 'troch_rt', $this->troch_rt]);

        return $dataProvider;
    }
}
