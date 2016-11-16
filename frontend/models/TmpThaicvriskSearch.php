<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TmpThaicvrisk;

/**
 * TmpThaicvriskSearch represents the model behind the search form of `app\models\TmpThaicvrisk`.
 */
class TmpThaicvriskSearch extends TmpThaicvrisk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'age'], 'integer'],
            [['vstdate', 'hn', 'vn', 'tname', 'bp', 'tc', 'sex', 'is_dm', 'smoker', 'waist', 'tcolor'], 'safe'],
            [['height'], 'number'],
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
        $query = "select * from swdata.tmp_thaicvrisk";

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
            'age' => $this->age,
            'height' => $this->height,
        ]);

        $query->andFilterWhere(['like', 'tcolor', $this->tcolor]);

        return $dataProvider;
    }
}
