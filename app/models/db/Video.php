<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "videos".
 *
 * @property int $id
 * @property string $title
 * @property string $link
 * @property string|null $createdAt
 */
class Video extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'videos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'link'], 'required', 'on' => ['create', 'update']],
            [['createdAt'], 'safe'],
            [['title', 'link'], 'string', 'max' => 255],
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
            'link' => 'Link',
            'createdAt' => 'Created At',
        ];
    }

    private function getYouTubeVideoID() {
        $pattern = '%^# Match any youtube URL
            (?:https?://)?           # Optional scheme. Either http or https
            (?:www\.)?               # Optional www subdomain
            (?:youtube\.com|youtu\.be)  # Match youtube.com or youtu.be
            (?:/watch\?v=|/embed/|/v/|/|/watch\?.+&v=|/shorts/)? # Match various parts of URL containing the video ID
            ([\w-]{11})              # Match the video ID (11 characters)
            ($|&|\?)                 # Match end of string or a parameter delimiter
            %x';

        $result = preg_match($pattern, $this->link, $matches);

        return ($result && isset($matches[1])) ? $matches[1] : false;
    }

    public function getYoutubeThumbnail() {
        return 'https://img.youtube.com/vi/'.$this->getYouTubeVideoID().'/hqdefault.jpg';
    }
}
