<?php

namespace app\models\db;

use app\models\abstractions\AbstractContentModel;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "blog_subcategories".
 *
 * Inherits AbstractContentModel fields:
 * @property int         $id
 * @property int|null    $languageId
 * @property string      $title
 * @property string|null $shortTitle
 * @property string|null $content
 * @property string|null $contentBottom
 * @property string|null $image
 * @property string|null $metaTitle
 * @property string|null $metaDescription
 * @property string|null $keywords
 * @property int         $isIndex
 * @property int         $isFollow
 * @property string|null $slug
 * @property string|null $headScript
 * @property string|null $bodyScript
 * @property int         $isHidden
 * @property int         $orderNumber
 *
 * @property int         $categoryId
 * @property BlogCategory $category
 */
class BlogSubcategory extends AbstractContentModel
{
    protected $imageAttrName = 'image';
    protected $path = 'img/subcategories/';

    public static function tableName()
    {
        return 'blog_subcategories';
    }

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['categoryId'], 'required', 'on' => ['create', 'update']],
            [['categoryId'], 'integer'],
            [['shortTitle'], 'string', 'max' => 128],
            [['contentBottom'], 'string'],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => BlogCategory::class, 'targetAttribute' => ['categoryId' => 'id']],
            // Optional: enforce unique slug per category at model level too (DB index already set)
            [['slug'], 'unique', 'targetAttribute' => ['categoryId', 'slug'], 'message' => 'Slug must be unique within the category.'],
        ]);
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'categoryId'   => 'Parent Category',
            'shortTitle'   => 'Subcategory Short Title',
            'contentBottom'=> 'Content Bottom',
        ]);
    }

    public function getCategory()
    {
        return $this->hasOne(BlogCategory::class, ['id' => 'categoryId']);
    }

    /**
     * If languageId is not explicitly set, inherit from parent category.
     */
    public function beforeValidate()
    {
        if (!$this->languageId && $this->categoryId) {
            $cat = $this->category ?: BlogCategory::findOne($this->categoryId);
            if ($cat && $cat->languageId) {
                $this->languageId = $cat->languageId;
            }
        }
        return parent::beforeValidate();
    }

    /**
     * Keep slugs sourced from 'title' consistently (same as AbstractContentModel).
     */
    public function getSlugAttribute()
    {
        return 'title';
    }

    /**
     * Default list ordering: within category by orderNumber, then by title.
     */
    public static function find()
    {
        return parent::find();
    }

    /**
     * Helper for dropdowns etc.
     */
    public static function getList(int $categoryId): array
    {
        $rows = self::find()->where(['categoryId' => $categoryId])->asArray()->all();
        return ArrayHelper::map($rows, 'id', 'title');
    }

    public function getPosts()
    {
        return $this->hasMany(Post::class, ['subcategoryId' => 'id'])
            ->inverseOf('subcategory');
    }

}
