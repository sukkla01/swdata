<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Reporttemplate;

/**
 * ReporttemplateSearch represents the model behind the search form of `app\models\Reporttemplate`.
 */
class ReporttemplateSearch extends Reporttemplate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['reportname', 'module', 'modulename', 'url', 'staff', 'tsql', 'create_date'], 'safe'],
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
        $query = Reporttemplate::find();

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
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'reportname', $this->reportname])
            ->andFilterWhere(['like', 'module', $this->module])
            ->andFilterWhere(['like', 'modulename', $this->modulename])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'staff', $this->staff])
            ->andFilterWhere(['like', 'tsql', $this->tsql]);

        return $dataProvider;
    }
}
