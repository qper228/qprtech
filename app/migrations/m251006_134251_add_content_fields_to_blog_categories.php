<?php

use yii\db\Migration;

class m251006_134251_add_content_fields_to_blog_categories extends Migration
{
    public function safeUp()
    {
        $table = 'blog_categories';

        $this->addColumn($table, 'languageId',     $this->integer()->null());
        $this->addColumn($table, 'title',          $this->string(128)->null());
        $this->addColumn($table, 'content',        $this->text()->null());
        $this->addColumn($table, 'image',          $this->string(128)->null());
        $this->addColumn($table, 'metaTitle',      $this->string(128)->null());
        $this->addColumn($table, 'metaDescription',$this->string(256)->null());
        $this->addColumn($table, 'keywords',       $this->string(256)->null());
        $this->addColumn($table, 'isIndex',        $this->boolean()->defaultValue(1));
        $this->addColumn($table, 'isFollow',       $this->boolean()->defaultValue(1));

        $this->addColumn($table, 'headScript',     $this->text()->null());
        $this->addColumn($table, 'bodyScript',     $this->text()->null());
        $this->addColumn($table, 'isHidden',       $this->boolean()->defaultValue(0));
        $this->addColumn($table, 'orderNumber',    $this->integer()->defaultValue(0));
        $this->addColumn($table, 'shortTitle',     $this->string(32)->null());
        $this->addColumn($table, 'contentBottom',  $this->text()->null());

        // Unique index on slug (ignore if it exists)
        try {
            $this->createIndex('ux_blog_categories_slug', $table, 'slug', true);
        } catch (\Throwable $e) {
            // noop: index already exists or SQLite name clash — safe to ignore
        }

        // FK not supported by SQLite via ALTER TABLE — skip there
        if ($this->db->driverName !== 'sqlite') {
            $this->addForeignKey(
                'fk_blog_categories_language',
                $table,
                'languageId',
                'language',
                'id',
                'SET NULL',
                'RESTRICT'
            );
        }
    }

    public function safeDown()
    {
        $table = 'blog_categories';

        try { $this->dropIndex('ux_blog_categories_slug', $table); } catch (\Throwable $e) {}

        $this->dropColumn($table, 'contentBottom');
        $this->dropColumn($table, 'shortTitle');
        $this->dropColumn($table, 'orderNumber');
        $this->dropColumn($table, 'isHidden');
        $this->dropColumn($table, 'bodyScript');
        $this->dropColumn($table, 'headScript');
        $this->dropColumn($table, 'isFollow');
        $this->dropColumn($table, 'isIndex');
        $this->dropColumn($table, 'keywords');
        $this->dropColumn($table, 'metaDescription');
        $this->dropColumn($table, 'metaTitle');
        $this->dropColumn($table, 'image');
        $this->dropColumn($table, 'content');
        $this->dropColumn($table, 'title');
        $this->dropColumn($table, 'languageId');
    }

}
