<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Research;

/**
 * ResearchSearch represents the model behind the search form of `app\models\Research`.
 */
class ResearchSearch extends Research
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'project_no'], 'integer'],
            [['projectname', 'research_name', 'dept', 'date_comfirm', 'note1', 'note2'], 'safe'],
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
        $query = Research::find();

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
            'project_no' => $this->project_no,
            'date_comfirm' => $this->date_comfirm,
        ]);

        $query->andFilterWhere(['like', 'projectname', $this->projectname])
            ->andFilterWhere(['like', 'research_name', $this->research_name])
            ->andFilterWhere(['like', 'dept', $this->dept])
            ->andFilterWhere(['like', 'note1', $this->note1])
            ->andFilterWhere(['like', 'note2', $this->note2]);

        return $dataProvider;
    }
}
