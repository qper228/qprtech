<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $subject
 * @property string $body
 * @property string $date
 */
class Contact extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone'], 'required', 'on' => ['create', 'update']],
            [['date'], 'safe'],
            [['subject', 'phone'], 'string', 'max' => 32],
            [['name', 'email'], 'string', 'max' => 128],
            [['body'], 'string'],
        ];
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) $this->date = date('Y-m-d H:i');
        return parent::beforeSave($insert);
    }
}
