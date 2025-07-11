<?php

namespace app\models\db;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property string $label
 * @property int $languageId
 * @property int|null $themeId
 * @property string $siteName
 * @property string|null $footerText
 * @property int $navAlign
 * @property int $isActive
 * @property string $logo
 * @property string $favicon
 * @property int $languageEnabled
 * @property string $logoUrl
 * @property int $logoWidth
 * @property string $email
 * @property string $emailSender
 * @property string $phone
 * @property Theme $theme
 * @property string $headScript
 * @property string $bodyScript
 */
class Settings extends ActiveRecord
{
    public $_logo;
    public $_favicon;

    public static function tableName()
    {
        return 'settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['label', 'languageId', 'siteName'], 'required', 'on' => ['create', 'update']],
            [['languageId', 'themeId', 'isActive', 'languageEnabled', 'logoWidth'], 'integer'],
            [['footerText', 'headScript', 'bodyScript'], 'string'],
            [['label', 'siteName', 'email'], 'string', 'max' => 64],
            [['logo', 'favicon', 'emailSender'], 'string', 'max' => 128],
            [['logoUrl'], 'string', 'max' => 256],
            [['navAlign', 'phone'], 'string', 'max' => 32],
            [['_logo', '_favicon'], 'file', 'extensions' => 'svg, png, gif, jpg, jpeg'],
            [['languageId'], 'exist', 'skipOnError' => false, 'targetClass' => Language::class, 'targetAttribute' => ['languageId' => 'id']],
            [['themeId'], 'exist', 'skipOnError' => false, 'targetClass' => Theme::class, 'targetAttribute' => ['themeId' => 'id']],
        ];
    }

    public function getLanguage()
    {
        return $this->hasOne(Language::class, ['id' => 'languageId']);
    }

    public function getTheme()
    {
        return $this->hasOne(Theme::class, ['id' => 'themeId']);
    }

    public static function getThemes() {
        $items = Theme::getList();
        $items[null] = '-';
        return $items;
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
            'themeId' => 'Theme',
            'siteName' => 'Site Name',
            'footerText' => 'Footer Text',
            'navAlign' => 'Navigation Align',
            'isActive' => 'Is Active',
            'logo' => 'Logo',
            'favicon' => 'Favicon',
            'languageEnabled' => 'Language Enabled',
            'logoUrl' => 'Logo Url',
        ];
    }

    /**
     * Get current lang settings
     *
     * @param string $lang
     *
     * @return ActiveRecord
     */
    public static function getActive($lang) {
        return self::find()
            ->joinWith('language')
            ->where(['isActive' => true])
            ->andWhere(['language.shortcut' => $lang])
            ->one();
    }

    public function beforeSave($insert) {
        $logo = UploadedFile::getInstance($this, '_logo');
        $favicon = UploadedFile::getInstance($this, '_favicon');
        if ($logo) {
            $filePath = $logo->baseName . '.' . $logo->extension;
            $logo->saveAs($filePath);
            $this->logo = '/'.$filePath;
        }
        if ($favicon) {
            $filePath = $favicon->baseName . '.' . $favicon->extension;
            $favicon->saveAs($filePath);
            $this->favicon = '/'.$filePath;
        }
        return parent::beforeSave($insert);
    }
}
