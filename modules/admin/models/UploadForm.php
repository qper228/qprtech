<?php

namespace app\modules\admin\models;

use yii\base\Model;

class UploadForm extends Model
{
    public $files;

    public function rules()
    {
        return [
            [['files'], 'file', 'skipOnEmpty' => false, 'maxFiles' => 10]
        ];
    }

}