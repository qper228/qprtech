<?php

namespace app\models\db;

use app\models\traits\SlugTrait;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "blog_categories".
 *
 * @property int $id
 * @property string $label
 * @property string $slug
 */
class BlogCategory extends ActiveRecord
{

    use SlugTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['label'], 'required', 'on' => ['create', 'update']],
            [['label', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => 'Label',
            'slug' => 'Slug',
        ];
    }

    public function getSlugAttribute() {
        return 'label';
    }

    public static function find()
    {
        return parent::find()->orderBy(['label' => SORT_ASC]);
    }

    public static function getList() {
        return ArrayHelper::map(self::find()->asArray()->all(), 'id', 'label');
    }

}
