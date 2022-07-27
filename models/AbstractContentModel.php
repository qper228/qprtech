<?php

namespace app\models;

use Sunrise\Slugger\Slugger;
use Yii;
use yii\bootstrap4\Breadcrumbs;

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

    public function rules()
    {
        return [
            [['title', 'orderNumber'], 'required', 'on' => ['create', 'update']],
            [['isIndex', 'isFollow', 'isHidden'], 'boolean'],
            [['languageId', 'orderNumber'], 'integer'],
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

    public function renderContent(){
        $replace = [
            'loginForm' => Yii::$app->controller->renderPartial('@app/views/site/login', [
                'model' => new LoginForm()
            ]),
            'contactForm' => Yii::$app->controller->renderPartial('@app/views/site/contact', [
                'model' => new ContactForm()
            ]),
            'breadCrumbs' => Breadcrumbs::widget([
                'links' => isset(Yii::$app->view->params['breadcrumbs']) ? Yii::$app->view->params['breadcrumbs'] : [],
            ]),
            'blog' => Yii::$app->controller->renderPartial('@app/views/site/blog', [
                'query' => Post::find()->where(['isHidden' => false])->orderBy(['id' => SORT_DESC])
            ])
        ];
        $content = $this->content;
        foreach ($replace as $k => $v) {
            $var = '{{ '.$k.' }}';
            if (str_contains($content, $var)) $content = str_replace($var, $v, $content);
        }
        return $content;
    }

    public function beforeSave($insert) {
        $slugger = new Slugger();
        $this->slug = $slugger->slugify($this->title);
        return parent::beforeSave($insert);
    }

}