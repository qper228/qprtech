<?php

namespace app\models\db;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "language".
 *
 * @property int $id
 * @property string $title
 * @property string $shortcut
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'shortcut'], 'required', 'on' => ['create', 'update']],
            [['title'], 'string', 'max' => 64],
            [['shortcut'], 'string', 'max' => 8],
            [['isDefault'], 'boolean'],
            [['shortcut'], 'unique']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'shortcut' => 'Shortcut',
        ];
    }

    public function icon($dimension = '1x1', $width = 25) {
        $shortcut = $this->shortcut;
        if ($shortcut === 'en') $shortcut = 'gb';
        return Html::img('@web/img/flags/'.$dimension.'/'.$shortcut.'.svg', [
            'width' => $width
        ]);
    }

    public static function getList() {
        $leads = self::find()->asArray()->all();
        return ArrayHelper::map($leads, 'id', 'title');
    }


}
