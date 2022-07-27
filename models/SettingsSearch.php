<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Settings;

/**
 * SettingsSearch represents the model behind the search form of `app\models\Settings`.
 */
class SettingsSearch extends Settings
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'languageId', 'themeId', 'navAlign', 'isActive', 'languageEnabled'], 'integer'],
            [['label', 'siteName', 'footerText', 'logo', 'favicon', 'logoUrl'], 'safe'],
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
        $query = Settings::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 25,
                'forcePageParam' => false,
                'pageSizeParam' => false,
            ],
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
            'languageId' => $this->languageId,
            'themeId' => $this->themeId,
            'navAlign' => $this->navAlign,
            'isActive' => $this->isActive,
            'languageEnabled' => $this->languageEnabled,
        ]);

        $query->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'siteName', $this->siteName])
            ->andFilterWhere(['like', 'footerText', $this->footerText])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'favicon', $this->favicon])
            ->andFilterWhere(['like', 'logoUrl', $this->logoUrl])
            ->orderBy(['id' => SORT_DESC]);

        return $dataProvider;
    }
}
