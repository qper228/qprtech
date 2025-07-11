<?php

namespace app\models\abstractions;

use Yii;
use yii\base\InvalidArgumentException;
use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\web\UploadedFile;

abstract class AbstractImageModel extends ActiveRecord {
    public $file;
    protected $imageAttrName = null;
    protected $path;

    function __construct($config = [])
    {
        if (!$this->imageAttrName || !$this->path) {
            throw new InvalidArgumentException(
                'You have to override `imageAttrName` & `path` attribute in child class'
            );
        }
        parent::__construct($config);
    }

    public function beforeSave($insert) {
        $file = UploadedFile::getInstance($this, 'file');
        if (!$file) {
            $file = UploadedFile::getInstanceByName('file');
        }
        if ($file) {
            $imageAttrName = $this->imageAttrName;
            $filename = $this->path . $file->baseName . '.' . $file->extension;
            $file->saveAs($filename);
            $this->$imageAttrName = '/'.$filename;
        }
        return parent::beforeSave($insert);
    }

    function image($width, $options = []) {
        $attr = $this->imageAttrName;
        $file = Yii::getAlias('@noPhoto');
        if ($this->$attr) $file = $this->$attr;
        return Html::img($file, array_merge(['width' => $width], $options));
    }
}