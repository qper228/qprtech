<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\BlogSubcategory;

/**
 * BlogSubcategorySearch represents the model behind the search form of `app\models\db\BlogSubcategory`.
 */
class BlogSubcategorySearch extends BlogSubcategory
{
    // Virtual attribute to filter by parent category name (label/title)
    public $categoryName;

    public function rules()
    {
        return [
            [['id', 'languageId', 'categoryId'], 'integer'],
            [['title', 'shortTitle', 'slug', 'categoryName'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = BlogSubcategory::find()->alias('s')
            ->joinWith(['category c']); // allow filtering/sorting by parent category

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Sorting by virtual field categoryName
        $dataProvider->sort->attributes['categoryName'] = [
            'asc'  => ['c.label' => SORT_ASC, 'c.title' => SORT_ASC],
            'desc' => ['c.label' => SORT_DESC, 'c.title' => SORT_DESC],
            'default' => SORT_ASC,
        ];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // Exact filters
        $query->andFilterWhere([
            's.id' => $this->id,
            's.languageId' => $this->languageId,
            's.categoryId' => $this->categoryId,
        ]);

        // Partial text filters
        $query->andFilterWhere(['like', 's.title', $this->title])
            ->andFilterWhere(['like', 's.shortTitle', $this->shortTitle])
            ->andFilterWhere(['like', 's.slug', $this->slug]);

        // Filter by parent category label or title
        if ($this->categoryName) {
            $query->andWhere([
                'or',
                ['like', 'c.label', $this->categoryName],
                ['like', 'c.title', $this->categoryName],
            ]);
        }

        return $dataProvider;
    }
}
