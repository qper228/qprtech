<?php

namespace app\models\db;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "ads".
 *
 * @property int $id
 * @property string $slot
 * @property string $html
 */
class Ad extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slot', 'html'], 'required', 'on' => ['create', 'update']],
            [['html'], 'string'],
            [['slot'], 'string', 'max' => 64],
            [['isActive'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slot' => 'Slot Position',
            'html' => 'HTML Code',
        ];
    }

    public function getSlotDisplay()
    {
        return $this->slots()[$this->slot];
    }

    /**
     * Returns list of predefined slots
     * Used in dropdowns like ActiveForm::dropDownList()
     *
     * @return array
     */
    public static function slots()
    {
        return [
            'home-top' => 'Top of Home Page',
            'under-hero' => 'Home Page Under Hero Section',
            'right-latest' => 'On the right of Latest Section',
            'under-latest' => 'Under Latest Section',
            'under-popular' => 'Under Popular Section',
            'under-editors' => 'Under Editor\'s Pick Section',
            'home-bottom' => 'Bottom of Home Page',
            'blog-top' => 'Top of Blog Page',
            'blog-categories' => 'Blog Categories Section',
            'blog-hero' => 'Blog Hero Section',
            'under-articles' => 'Under Blog Articles Section',
            'blog-bottom' => 'Bottom of Blog Page',
            'article-top' => 'Top of Article Page',
            'article-under-title' => 'Article Under Title',
            'article-side' => 'Side of Article Page',
            'article-bottom' => 'Bottom of Article Page',
        ];
    }
}