<?php

namespace app\models\db;

use yii\db\ActiveRecord;
use yii\helpers\Html;

/**
 * This is the model class for table "socials".
 *
 * @property int $id
 * @property string $icon
 * @property string $link
 * @property int $isActive
 * @property int $languageId
 */
class Social extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'socials';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['icon', 'link', 'languageId'], 'required', 'on' => ['create', 'update']],
            [['isActive'], 'boolean'],
            [['icon'], 'string', 'max' => 32],
            [['link'], 'string', 'max' => 128],
            [['languageId'], 'exist', 'skipOnError' => false, 'targetClass' => Language::class, 'targetAttribute' => ['languageId' => 'id']],
        ];
    }

    public function getLanguage()
    {
        return $this->hasOne(Language::class, ['id' => 'languageId']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'icon' => 'Icon',
            'link' => 'Link',
            'isActive' => 'Is Active',
            'languageId' => 'Language'
        ];
    }

    public static function getIcons(){
        $socials = [
            'facebook',
            'instagram',
            'youtube',
            'twitter',
            'discord',
            'linkedin',
            'medium',
            'viber',
            'whatsapp',
            'telegram',
            'weixin',
            'behance',
            'blogger',
            'github',
            'reddit',
            'pinterest',
            'skype',
            'vimeo'
        ];
        sort($socials);
        $arr = [];
        foreach ($socials as $social) {
            $arr[$social] = ucfirst($social);
        }
        return $arr;
    }

    public function render() {
        return Html::a(
            '<i class="fa-brands fa-'.$this->icon.' fa-2xl"></i>',
            $this->link,
            [
                'target' => '_blank'
            ]
        );
    }

    public static function getActive($language) {
        return self::find()
            ->joinWith('language')
            ->where([
                'isActive' => true,
                'language.shortcut' => $language
            ])
            ->all();
    }
}
