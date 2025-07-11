<?php

namespace app\models\search;

use app\models\db\Post;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PageSearch represents the model behind the search form of `app\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'languageId', 'isIndex', 'isFollow', 'isHidden', 'views', 'categoryId'], 'integer'],
            [['title', 'preview', 'content', 'image', 'metaTitle', 'metaDescription', 'keywords', 'slug', 'headScript', 'bodyScript'], 'safe'],
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
        $query = Post::find();

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
            'categoryId' => $this->categoryId,
            'isIndex' => $this->isIndex,
            'isFollow' => $this->isFollow,
            'isHidden' => $this->isHidden,
            'views' => $this->views,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'metaTitle', $this->metaTitle])
            ->andFilterWhere(['like', 'metaDescription', $this->metaDescription])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'headScript', $this->headScript])
            ->andFilterWhere(['like', 'bodyScript', $this->bodyScript])
            ->orderBy(['id' => SORT_DESC]);

        return $dataProvider;
    }
}
