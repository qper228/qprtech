<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;

class FileForm extends Model
{
    public $content = '';
    /** Use an alias-friendly path, e.g. '@app/web/css/custom.css' */
    protected $path;

    /** Absolute path resolved from $path */
    private $absPath;

    public function init()
    {
        parent::init();

        // Resolve to absolute path safely
        $this->absPath = Yii::getAlias($this->path ?: '@app');

        // Load file contents if readable; otherwise keep empty string
        if (is_file($this->absPath) && is_readable($this->absPath)) {
            $data = @file_get_contents($this->absPath);
            $this->content = ($data === false) ? '' : $data;
        }
    }

    public function rules()
    {
        return [
            ['content', 'string'],
        ];
    }

    public function write(): bool
    {
        // Ensure target directory exists
        FileHelper::createDirectory(dirname($this->absPath));

        // Write and check for errors
        $bytes = @file_put_contents($this->absPath, (string)$this->content, LOCK_EX);
        if ($bytes === false) {
            $this->addError('content', 'Failed to write the file. Check file permissions (web server user must have write access).');
            return false;
        }
        return true;
    }
}
