<?php

namespace app\models\traits;

use Sunrise\Slugger\Slugger;

trait SlugTrait
{
    abstract protected function getSlugAttribute();
    public function beforeSave($insert)
    {
        if (empty($this->slug) || $this->slug === 'NULL') {
            $slugger = new Slugger();
            $attr = $this->getSlugAttribute();
            $baseSlug = $slugger->slugify($this->$attr);
            $slug = $baseSlug;
            $i = 1;

            $class = get_class($this);

            // Ensure uniqueness
            while ($class::find()->where(['slug' => $slug])->exists()) {
                $slug = $baseSlug . '-' . $i++;
            }

            $this->slug = $slug;
        }

        return parent::beforeSave($insert);
    }

}