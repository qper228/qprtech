<?php
use yii\db\Migration;

class m251007_124110_create_blog_subcategories extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%blog_subcategories}}', [
            'id'              => $this->primaryKey(),
            'categoryId'      => $this->integer()->notNull(),
            'languageId'      => $this->integer()->null(),
            'title'           => $this->string(128)->notNull(),
            'shortTitle'      => $this->string(128)->null(),
            'content'         => $this->text()->null(),
            'contentBottom'   => $this->text()->null(),
            'image'           => $this->string(128)->null(),
            'metaTitle'       => $this->string(128)->null(),
            'metaDescription' => $this->string(256)->null(),
            'keywords'        => $this->string(256)->null(),
            'isIndex'         => $this->boolean()->notNull()->defaultValue(1),
            'isFollow'        => $this->boolean()->notNull()->defaultValue(1),
            'slug'            => $this->string(256)->null(),
            'headScript'      => $this->text()->null(),
            'bodyScript'      => $this->text()->null(),
            'isHidden'        => $this->boolean()->notNull()->defaultValue(0),
            'orderNumber'     => $this->integer()->notNull()->defaultValue(0),
            'created_at'      => $this->integer()->null(),
            'updated_at'      => $this->integer()->null(),
        ]);

        // Indexes (work on all DBs)
        $this->createIndex('idx_blog_subcategories_category', '{{%blog_subcategories}}', 'categoryId');
        $this->createIndex('idx_blog_subcategories_language', '{{%blog_subcategories}}', 'languageId');
        $this->createIndex('ux_blog_subcategories_category_slug', '{{%blog_subcategories}}', ['categoryId', 'slug'], true);
        $this->createIndex('idx_blog_subcategories_order', '{{%blog_subcategories}}', ['categoryId', 'orderNumber']);

        // Add FKs only when the driver supports ALTER TABLE ADD FK (not SQLite)
        if ($this->db->driverName !== 'sqlite') {
            $this->addForeignKey(
                'fk_blog_subcategories_category',
                '{{%blog_subcategories}}',
                'categoryId',
                '{{%blog_categories}}',
                'id',
                'CASCADE',
                'CASCADE'
            );
            $this->addForeignKey(
                'fk_blog_subcategories_language',
                '{{%blog_subcategories}}',
                'languageId',
                '{{%languages}}',
                'id',
                'SET NULL',
                'CASCADE'
            );
        }
    }

    public function safeDown()
    {
        if ($this->db->driverName !== 'sqlite') {
            $this->dropForeignKey('fk_blog_subcategories_category', '{{%blog_subcategories}}');
            $this->dropForeignKey('fk_blog_subcategories_language', '{{%blog_subcategories}}');
        }
        $this->dropTable('{{%blog_subcategories}}');
    }
}
