<?php

namespace app\models;

/**
 *
 * @property int $views
 * @property string $preview
 *
 */
class Post extends AbstractContentModel {

    protected $imageAttrName = 'image';
    protected $path = 'img/posts/';

    public static function tableName()
    {
        return 'post';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(),
            [
                [['views'], 'integer'],
                [['preview'], 'string', 'max' => 256],
            ]
        );
    }

    public function attributeLabels()
    {
        return array_merge(
            parent::attributeLabels(),
            [
                'views' => 'Views',
                'preview' => 'Preview',
            ]
        );
    }

}
