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
        if (!parent::beforeSave($insert)) {
            return false;
        }

        // Prefer an explicitly attached file (controller), else model-scoped field (Post[file])
        $uploaded = ($this->file instanceof UploadedFile)
            ? $this->file
            : UploadedFile::getInstance($this, 'file');

        // Only proceed for a real successful upload
        if (!$uploaded || $uploaded->error !== UPLOAD_ERR_OK || (int)$uploaded->size === 0) {
            return true; // no upload for THIS model
        }

        // Build absolute dir under webroot and ensure it exists
        $dir = \Yii::getAlias('@webroot/' . trim($this->path, '/')); // e.g. web/img/posts
        FileHelper::createDirectory($dir, 0775, true);

        // Unique, safe filename
        $base = preg_replace('/[^a-z0-9_-]+/i', '-', pathinfo($uploaded->baseName, PATHINFO_FILENAME)) ?: 'image';
        $ext  = strtolower($uploaded->getExtension());
        $name = $base . '-' . \Yii::$app->security->generateRandomString(8) . '.' . $ext;

        if (!$uploaded->saveAs($dir . DIRECTORY_SEPARATOR . $name)) {
            $this->addError('file', 'Failed to save uploaded file.');
            return false;
        }

        // Save public URL path into the image attribute
        $attr = $this->imageAttrName; // e.g. 'image'
        $this->$attr = '/' . trim($this->path, '/') . '/' . $name;

        return true;
    }

    function image($width, $options = []) {
        $attr = $this->imageAttrName;
        $file = Yii::getAlias('@noPhoto');
        if ($this->$attr) $file = $this->$attr;
        return Html::img($file, array_merge(['width' => $width], $options));
    }
}