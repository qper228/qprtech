<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;

class FileForm extends Model
{
    public $content;
    protected $path;

    public function __construct($config = [])
    {
        $path = Yii::$app->basePath.$this->path;
        $this->content = file_get_contents($path);
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['content', 'string']
        ];
    }

    public function write() {
        file_put_contents(Yii::$app->basePath.$this->path, $this->content);
        return true;
    }

}