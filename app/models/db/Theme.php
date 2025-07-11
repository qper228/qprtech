<?php

namespace app\models\db;

use Sunrise\Slugger\Slugger;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "themes".
 *
 * @property int $id
 * @property string $label
 * @property int $jsFile
 * @property int $cssFile
 * @property int $isActive
 */
class Theme extends \yii\db\ActiveRecord
{
    public $fileJs;
    public $fileCss;
    private $path = 'themes/';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'themes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['label'], 'required', 'on' => ['create', 'update']],
            [['jsFile', 'cssFile'],  'string', 'max' => 128],
            [['isActive'], 'boolean'],
            [['label'], 'string', 'max' => 64],
            [['navbarColor'], 'string', 'max' => 32],
            [['fileJs', 'fileCss'], 'file', 'extensions' => 'css, js'],
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
            'jsFile' => 'Js File',
            'cssFile' => 'Css File',
            'isActive' => 'Is Active',
        ];
    }

    public function getJs() {
        return $this->jsFile;
    }

    public function getCss() {
        return $this->cssFile;
    }

    public static function getList() {
        $themes = self::find()->where(['isActive' => true])->asArray()->all();
        return ArrayHelper::map($themes, 'id', 'label');
    }

    public function beforeSave($insert) {
        $fileJs = UploadedFile::getInstance($this, 'fileJs');
        $fileCss = UploadedFile::getInstance($this, 'fileCss');
        $slugger = new Slugger();
        $slug = $slugger->slugify($this->label);
        $dirPath = $this->path . $slug;
        if ($this->isNewRecord) mkdir(Yii::$app->basePath .'/web/'. $dirPath);
        if ($fileJs) {
            $filePath = $dirPath .'/'. $fileJs->baseName . '.' . $fileJs->extension;
            $fileJs->saveAs($filePath);
            $this->jsFile = '/'.$filePath;
        }
        if ($fileCss) {
            $filePath = $dirPath .'/'. $fileCss->baseName . '.' . $fileCss->extension;
            $fileCss->saveAs($filePath);
            $this->cssFile = '/'.$filePath;
        }
        return parent::beforeSave($insert);
    }
}
