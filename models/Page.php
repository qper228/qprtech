<?php

namespace app\models;

use Sunrise\Slugger\Slugger;

/**
 * This is the model class for table "page".
 *
 * @property int $isHomePage
 * @property int $sectionId
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
                [['isHomePage'], 'boolean'],
                [['shortTitle'], 'string', 'max' => 32],
                [['sectionId'], 'exist', 'skipOnError' => true, 'targetClass' => Section::class, 'targetAttribute' => ['sectionId' => 'id']],
            ]
        );
    }

    public function attributeLabels()
    {
        return array_merge(
            parent::attributeLabels(),
            [
                'sectionId' => 'Section',
                'isHomePage' => 'Is Home Page',
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
            $slugger = new Slugger();
            $this->slug = $slugger->slugify($this->title);
        }
        return parent::beforeSave($insert);
    }
}
