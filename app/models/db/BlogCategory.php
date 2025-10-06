<?php

namespace app\models\db;

use app\models\abstractions\AbstractContentModel;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "blog_categories".
 *
 * Inherits all AbstractContentModel fields:
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
 * Legacy/local fields:
 * @property string      $label   // kept for backward-compat, mirrors $title
 */
class BlogCategory extends AbstractContentModel
{
    protected $imageAttrName = 'image';
    protected $path = 'img/categories/';

    public static function tableName()
    {
        return 'blog_categories';
    }

    public function rules()
    {
        // Merge parent rules with legacy `label`
        return ArrayHelper::merge(parent::rules(), [
            [['label'], 'string', 'max' => 255],
            // If you still want DB-level uniqueness on slug, keep it at DB.
            // You can also add a 'unique' validator here if desired.
        ]);
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'label'       => 'Label',
            'shortTitle'  => 'Category Short Title',
            'contentBottom' => 'Content Bottom',
        ]);
    }

    /**
     * Keep label <-> title in sync to avoid breaking existing UI.
     * If either is missing, copy from the other.
     */
    public function beforeValidate()
    {
        if (!$this->title && $this->label) {
            $this->title = $this->label;
        } elseif (!$this->label && $this->title) {
            $this->label = $this->title;
        }

        return parent::beforeValidate();
    }

    /**
     * If you rely on SlugTrait's "source attribute", keep it consistent with Page:
     * AbstractContentModel already defines getSlugAttribute() => 'title'.
     * You can override here if you prefer 'label'.
     */
    public function getSlugAttribute()
    {
        return 'title';
    }

    /**
     * Default ordering (categories in a defined order, then label as tie-breaker).
     */
    public static function find()
    {
        return parent::find()->orderBy(['label' => SORT_ASC]);
    }

    /**
     * Helper for dropdowns etc.
     * Switch to 'title' if you prefer the new field.
     */
    public static function getList()
    {
        return ArrayHelper::map(self::find()->asArray()->all(), 'id', 'label');
    }
}
