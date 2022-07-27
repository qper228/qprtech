<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "section".
 *
 * @property int $id
 * @property string $label
 * @property int $languageId
 * @property int $position
 * @property int $orderNumber
 * @property string|null $class
 * @property string|null $scrollTo
 * @property string|null $url
 * @property int $newTab
 * @property bool $isActive
 * @property Language $language
 */
class Section extends \yii\db\ActiveRecord
{
    public static $positionTop = 1;
    public static $positionBottom = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'section';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['label', 'languageId'], 'required', 'on' => ['create', 'update']],
            [['languageId', 'position', 'newTab'], 'integer'],
            [['label'], 'string', 'max' => 32],
            [['class'], 'string', 'max' => 128],
            [['scrollTo'], 'string', 'max' => 64],
            [['url'], 'string', 'max' => 256],
            [['orderNumber'], 'integer', 'min' => 1],
            [['isActive'], 'boolean'],
            [['languageId'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['languageId' => 'id']],
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
            'languageId' => 'Language',
            'position' => 'Position',
            'orderNumber' => 'Order Number',
            'class' => 'Class',
            'scrollTo' => 'Scroll To',
            'url' => 'Url',
            'newTab' => 'New Tab',
        ];
    }

    /**
     * Gets query for [[Language]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::class, ['id' => 'languageId']);
    }

    public static function getPositions() {
        return [
            1 => 'Navigation',
            2 => 'Footer'
        ];
    }

    public function getPositionName() {
        return self::getPositions()[$this->position];
    }

    public static function getList() {
        $leads = self::find()->asArray()->all();
        return ArrayHelper::map($leads, 'id', 'label');
    }

    public function getPages() {
        return Page::find()->where(['sectionId' => $this->id])->orderBy(['orderNumber' => SORT_ASC]);
    }

    private static function getLinks($languageId, $position) {
        return ArrayHelper::toArray(self::find()->where([
            'languageId' => $languageId,
            'position' => $position,
            'isActive' => true
        ])->orderBy(['position' => SORT_ASC])->all(), [
            'app\models\Section' => [
                'label' => 'label',
                'options' => function ($section) {
                    return [
                        'class' => $section->class
                    ];
                },
                'linkOptions' => function ($section) {
                    return [
                        'target' => $section->newTab ? '_blank' : '_self',
                        'class' => $section->scrollTo ? 'scroll-to' : ''
                    ];
                },
                'url' => function ($section) {
                    $pages = $section->getPages();
                    if ($pages->count() == 1) {
                        $page = $pages->one();
                        return Url::to(['/site/page', 'slug' => $page->slug]);
                    } else if ($section->url) {
                        return Url::to($section->url);
                    }
                    else if ($section->scrollTo) {
                        return [
                            '/',
                            '#' => $section->scrollTo,
                        ];
                    }
                    return null;
                },
                'items' => function($section) {
                    $pages = $section->getPages();
                    if ($pages->count() > 1) {
                        $pages = $pages->all();
                        $items = [];
                        foreach ($pages as $page) {
                            $items[] = [
                                'label' => $page->shortTitle,
                                'url' => Url::to(['/site/page', 'slug' => $page->slug]),
                                'linkOptions' => [
                                    'class' => 'dropdown-item-link',
                                    'target' => $section->newTab ? '_blank' : '_self'
                                ]
                            ];
                        }
                        return $items;
                    }
                    return null;
                }
            ]
        ]);
    }

    public static function getNavigationLinks($languageId) {
        return self::getLinks($languageId, self::$positionTop);
    }

    public static function getFooterLinks($languageId) {
        return self::getLinks($languageId, self::$positionBottom);
    }
}
