<?php

namespace app\models\db;

use app\models\abstractions\AbstractContentModel;

/**
 *
 * @property int $views
 * @property int $categoryId
 * @property int subcategoryId
 * @property string $preview
 * @property BlogCategory $category
 * @property string $createdAt
 *
 */
class Post extends AbstractContentModel {
    protected $imageAttrName = 'image';
    protected $path = 'img/posts/';

    public static function tableName()
    {
        return 'post';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(),
            [
                [['views', 'categoryId', 'subcategoryId'], 'integer'],
                [['preview'], 'string', 'max' => 256],
                [['isEditorsPick'], 'boolean'],
            ]
        );
    }

    public function attributeLabels()
    {
        return array_merge(
            parent::attributeLabels(),
            [
                'views' => 'Views',
                'preview' => 'Preview',
                'categoryId' => 'Category',
                'subcategoryId' => 'Subcategory',
            ]
        );
    }

    public function getCategory()
    {
        return $this->hasOne(BlogCategory::class, ['id' => 'categoryId'])
            ->alias('bc')
            ->inverseOf('posts');
    }

    public function getSubcategory()
    {
        return $this->hasOne(BlogSubcategory::class, ['id' => 'subcategoryId'])
            ->alias('bsc')
            ->inverseOf('posts');
    }


    public static function getCategories() {
        $items = BlogCategory::getList();
        $items[null] = '-';
        return $items;
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            if (!$this->metaTitle) {
                $this->metaTitle = $this->title;
            }
            if (!$this->metaDescription) {
                $this->metaDescription = $this->preview;
            }
        }
        return parent::beforeSave($insert);
    }

}
