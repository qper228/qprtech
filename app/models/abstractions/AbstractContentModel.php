<?php

namespace app\models\abstractions;

use app\models\db\Language;
use app\models\traits\SlugTrait;
use Yii;

/**
 * @property int $id
 * @property int $languageId
 * @property string $title
 * @property string|null $content
 * @property string|null $image
 * @property string|null $metaTitle
 * @property string|null $metaDescription
 * @property string|null $keywords
 * @property int $isIndex
 * @property int $isFollow
 * @property string|null $slug
 * @property string $headScript
 * @property string $bodyScript
 * @property int $isHidden
 * @property int $orderNumber
 * @property Language $language
 */

abstract class AbstractContentModel extends AbstractImageModel
{
    use SlugTrait;

    public function rules()
    {
        return [
            [['title', 'orderNumber'], 'required', 'on' => ['create', 'update']],
            [['isIndex', 'isFollow', 'isHidden'], 'boolean'],
            [['languageId', 'orderNumber'], 'integer'],
            [['orderNumber'], 'default', 'value' => 0],
            [['content', 'headScript', 'bodyScript'], 'string'],
            [['title', 'image', 'metaTitle'], 'string', 'max' => 128],
            [['metaDescription', 'keywords', 'slug'], 'string', 'max' => 256],
            [['languageId'], 'exist', 'skipOnError' => true, 'targetClass' => Language::class, 'targetAttribute' => ['languageId' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'languageId' => 'Language',
            'title' => 'Title',
            'content' => 'Content',
            'image' => 'Image',
            'metaTitle' => 'Meta Title',
            'metaDescription' => 'Meta Description',
            'keywords' => 'Keywords',
            'isIndex' => 'Is Index',
            'isFollow' => 'Is Follow',
            'slug' => 'Slug',
            'headScript' => 'Head Script',
            'bodyScript' => 'Body Script',
            'isHidden' => 'Is Hidden',
            'orderNumber' => 'Order Number',
        ];
    }

    public function getLanguage() {
        return $this->hasOne(Language::class, ['id' => 'languageId']);
    }

    public function renderContent($content = null){
        if (!$content) {
            $content = $this->content;
        }
        $replace = [
            'leadForm' => Yii::$app->controller->renderPartial('@app/views/components/lead_form'),
            'contactForm' => Yii::$app->controller->renderPartial('@app/views/components/contact_form'),
            'websiteName' => Yii::$app->params['websiteName']
        ];
        foreach ($replace as $k => $v) {
            $var = '{{ '.$k.' }}';
            if (str_contains($content, $var)) $content = str_replace($var, $v, $content);
        }
        return $content;
    }

    public function getSlugAttribute() {
        return 'title';
    }

    public function getOgTags()
    {
        return [
            'title' => $this->title,
            'metaTitle' => $this->metaTitle,
            'metaDescription' => $this->metaDescription,
            'keywords' => $this->keywords,
            'index' => $this->isIndex,
            'follow' => $this->isFollow,
            'image' => $this->image,
        ];
    }

}