<?php

namespace app\modules\rreport\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\rreport\models\ReportRequest;

/**
 * ReportRequestSearch represents the model behind the search form of `app\modules\rreport\models\ReportRequest`.
 */
class ReportRequestSearch extends ReportRequest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['detail', 'user', 'header', 'status', 'date_line', 'staff'], 'safe'],
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
        $query = ReportRequest::find();

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
            'date_line' => $this->date_line,
        ]);

        $query->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'user', $this->user])
            ->andFilterWhere(['like', 'header', $this->header])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'staff', $this->staff]);

        return $dataProvider;
    }
}
