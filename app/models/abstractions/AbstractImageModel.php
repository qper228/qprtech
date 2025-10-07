<?php

namespace app\models\abstractions;

use Yii;
use yii\base\InvalidArgumentException;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
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

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) return false;

        /** @var UploadedFile|null $uploaded */
        $uploaded = ($this->file instanceof UploadedFile)
            ? $this->file
            : UploadedFile::getInstance($this, 'file');

        if (!$uploaded || $uploaded->error !== UPLOAD_ERR_OK || (int)$uploaded->size === 0) {
            return true; // no upload for THIS model
        }

        // 1) Build absolute target dir under @webroot + date subfolder
        $basePath = \Yii::getAlias('@webroot/' . trim($this->path, '/')); // e.g. web/img/posts
        $subdir   = date('Y/m');                                         // e.g. 2025/10
        $dir      = $basePath . DIRECTORY_SEPARATOR . $subdir;
        FileHelper::createDirectory($dir, 0775, true);

        // 2) Generate safe, unique filename (ignore original "thumbnail.webp")
        $ext   = strtolower($uploaded->getExtension());
        $slug  = preg_replace('/[^a-z0-9_-]+/i', '-', pathinfo($uploaded->baseName, PATHINFO_FILENAME)) ?: 'image';
        $uniq  = \Yii::$app->security->generateRandomString(8);
        $stamp = gmdate('YmdHis');
        $name  = strtolower("{$slug}-{$stamp}-{$uniq}.{$ext}");

        // 3) Save and set public URL path to model attribute
        $fsPath = $dir . DIRECTORY_SEPARATOR . $name;
        if (!$uploaded->saveAs($fsPath)) {
            $this->addError('file', 'Failed to save uploaded file.');
            return false;
        }

        $attr = $this->imageAttrName; // e.g. 'image'
        $this->$attr = '/' . trim($this->path, '/') . '/' . $subdir . '/' . $name;

        return true;
    }

    function image($width, $options = []) {
        $attr = $this->imageAttrName;
        $file = Yii::getAlias('@noPhoto');
        if ($this->$attr) $file = $this->$attr;
        return Html::img($file, array_merge(['width' => $width], $options));
    }
}