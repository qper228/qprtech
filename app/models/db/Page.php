<?php

namespace app\models\db;

use app\models\abstractions\AbstractContentModel;
use Sunrise\Slugger\Slugger;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "page".
 *
 * @property int $isHomePage
 * @property int $sectionId
 * @property string $shortTitle
 * @property string $contentBottom
 *
 */
class Page extends AbstractContentModel {
    protected $imageAttrName = 'image';
    protected $path = 'img/pages/';

    public static function tableName()
    {
        return 'page';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(),
            [
                [['shortTitle'], 'required', 'on' => ['create', 'update']],
                [['sectionId'], 'integer'],
                [['isHomePage', 'isBlogPage', 'isVideoPage'], 'boolean'],
                [['shortTitle'], 'string', 'max' => 32],
                [['contentBottom'], 'string'],
                [['sectionId'], 'exist', 'skipOnError' => true, 'targetClass' => Section::class, 'targetAttribute' => ['sectionId' => 'id']],
            ]
        );
    }

    public function attributeLabels()
    {
        return array_merge(
            parent::attributeLabels(),
            [
                'shortTitle' => 'Page Title',
                'sectionId' => 'Section',
                'isHomePage' => 'Is Home Page',
                'isBlogPage' => 'Is Blog Page',
                'contentBottom' => 'Content Bottom',
            ]
        );
    }

    public function getSection()
    {
        return $this->hasOne(Section::class, ['id' => 'sectionId']);
    }

    public static function getSections() {
        $items = Section::getList();
        $items[null] = '-';
        return $items;
    }

    public function beforeSave($insert) {
        if ($this->isHomePage) {
            $this->slug = 'index';
        } else {
            if ($this->isNewRecord && !$this->slug) {
                $slugger = new Slugger();
                $this->slug = $slugger->slugify($this->title);
            }
        }
        return parent::beforeSave($insert);
    }
}
