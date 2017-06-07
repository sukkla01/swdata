<?php

namespace app\modules\quest\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\quest\models\Quest;

/**
 * QuestSearch represents the model behind the search form of `app\modules\quest\models\Quest`.
 */
class QuestSearch extends Quest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['tname', 'position', 'dept', 'inject_date', 'inject_time', 'mm', 'pb', 'ns', 'pk', 'pl', 'nt', 'td', 'ps', 'pi', 'ot', 's_mm', 's_pb', 's_kh', 's_ns', 's_pk', 's_pl', 's_nt', 's_td', 's_ps', 's_pi', 's_ot', 'e_mm', 'e_pb', 'e_kh', 'e_ns', 'e_pk', 'e_pl', 'e_nt', 'e_td', 'e_ps', 'e_pi', 'e_ot'], 'safe'],
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
        $query = Quest::find();

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
            'inject_date' => $this->inject_date,
            'inject_time' => $this->inject_time,
            's_mm' => $this->s_mm,
            's_pb' => $this->s_pb,
            's_kh' => $this->s_kh,
            's_ns' => $this->s_ns,
            's_pk' => $this->s_pk,
            's_pl' => $this->s_pl,
            's_nt' => $this->s_nt,
            's_td' => $this->s_td,
            's_ps' => $this->s_ps,
            's_pi' => $this->s_pi,
            's_ot' => $this->s_ot,
            'e_mm' => $this->e_mm,
            'e_pb' => $this->e_pb,
            'e_kh' => $this->e_kh,
            'e_ns' => $this->e_ns,
            'e_pk' => $this->e_pk,
            'e_pl' => $this->e_pl,
            'e_nt' => $this->e_nt,
            'e_td' => $this->e_td,
            'e_ps' => $this->e_ps,
            'e_pi' => $this->e_pi,
            'e_ot' => $this->e_ot,
        ]);

        $query->andFilterWhere(['like', 'tname', $this->tname])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'dept', $this->dept])
            ->andFilterWhere(['like', 'mm', $this->mm])
            ->andFilterWhere(['like', 'pb', $this->pb])
            ->andFilterWhere(['like', 'ns', $this->ns])
            ->andFilterWhere(['like', 'pk', $this->pk])
            ->andFilterWhere(['like', 'pl', $this->pl])
            ->andFilterWhere(['like', 'nt', $this->nt])
            ->andFilterWhere(['like', 'td', $this->td])
            ->andFilterWhere(['like', 'ps', $this->ps])
            ->andFilterWhere(['like', 'pi', $this->pi])
            ->andFilterWhere(['like', 'ot', $this->ot]);

        return $dataProvider;
    }
}
