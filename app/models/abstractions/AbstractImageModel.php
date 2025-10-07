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
        // call parent first, and abort if it fails
        if (!parent::beforeSave($insert)) {
            return false;
        }

        // Only pick up a file bound to THIS model (e.g. Post[file])
        /** @var UploadedFile|null $uploaded */
        $uploaded = UploadedFile::getInstance($this, 'file');

        // If no real upload for this model, do nothing
        if (!$uploaded || $uploaded->error !== UPLOAD_ERR_OK || (int)$uploaded->size === 0) {
            return true;
        }

        // Prepare filesystem dir under webroot
        $dir = Yii::getAlias('@webroot/' . trim($this->path, '/')); // e.g. web/img/categories
        FileHelper::createDirectory($dir, 0775, true);

        // Generate a safe unique filename
        $base = preg_replace('/[^a-z0-9_-]+/i', '-', pathinfo($uploaded->baseName, PATHINFO_FILENAME)) ?: 'image';
        $ext  = strtolower($uploaded->getExtension());
        $name = $base . '-' . Yii::$app->security->generateRandomString(8) . '.' . $ext;

        // Save to disk
        $fsPath = $dir . DIRECTORY_SEPARATOR . $name;
        if (!$uploaded->saveAs($fsPath)) {
            $this->addError('file', 'Failed to save uploaded file.');
            return false;
        }

        // Persist public URL to model's image attribute
        $attr = $this->imageAttrName;      // e.g. 'image'
        $this->$attr = '/' . trim($this->path, '/') . '/' . $name;  // e.g. /img/categories/abc123.webp

        return true;
    }

    function image($width, $options = []) {
        $attr = $this->imageAttrName;
        $file = Yii::getAlias('@noPhoto');
        if ($this->$attr) $file = $this->$attr;
        return Html::img($file, array_merge(['width' => $width], $options));
    }
}