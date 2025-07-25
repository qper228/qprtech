<?php

namespace app\models\search;

use app\models\db\Theme;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ThemeSearch represents the model behind the search form of `app\models\Theme`.
 */
class ThemeSearch extends Theme
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'isActive'], 'integer'],
            [['label', 'jsFile', 'cssFile'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Theme::find();

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
            'isActive' => $this->isActive,
        ]);

        $query->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'jsFile', $this->jsFile])
            ->andFilterWhere(['like', 'cssFile', $this->cssFile]);

        return $dataProvider;
    }
}
