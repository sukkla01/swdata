<?php

namespace app\modules\oapp\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\oapp\models\OappEvent;

/**
 * OappEventSearch represents the model behind the search form of `app\modules\oapp\models\OappEvent`.
 */
class OappEventSearch extends OappEvent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cid'], 'integer'],
            [['hn', 'tname', 'pttype', 'tel', 'created_date', 'note1', 'note2', 'note3', 'spclty'], 'safe'],
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
        $query = OappEvent::find();

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
            'cid' => $this->cid,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'hn', $this->hn])
            ->andFilterWhere(['like', 'tname', $this->tname])
            ->andFilterWhere(['like', 'pttype', $this->pttype])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'note1', $this->note1])
            ->andFilterWhere(['like', 'note2', $this->note2])
            ->andFilterWhere(['like', 'note3', $this->note3])
            ->andFilterWhere(['like', 'spclty', $this->spclty]);

        return $dataProvider;
    }
}
