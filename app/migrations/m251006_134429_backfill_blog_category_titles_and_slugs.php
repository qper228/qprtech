<?php

use yii\db\Migration;

class m251006_134429_backfill_blog_category_titles_and_slugs extends Migration
{
    public function safeUp()
    {
        $rows = (new \yii\db\Query())
            ->from('blog_categories')
            ->select(['id', 'label', 'title', 'slug'])
            ->all();

        foreach ($rows as $r) {
            $title = $r['title'];
            if (!$title || trim($title) === '') {
                $title = $r['label'] ?? '';
            }

            $slug = $r['slug'];
            if (!$slug || trim($slug) === '') {
                $slug = $this->slugify($title);
            }

            $this->update(
                'blog_categories',
                ['title' => $title, 'slug' => $slug],
                ['id' => $r['id']]
            );
        }
    }

    public function safeDown()
    {
        // No-op: we won't revert backfill.
        return true;
    }

    private function slugify(string $text): string
    {
        $text = mb_strtolower($text, 'UTF-8');
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        // transliterate if you have intl extension
        if (function_exists('iconv')) {
            $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
        }
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        return $text ?: 'category';
    }
}
