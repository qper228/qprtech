<?php

use yii\db\Migration;

class m251007_134514_add_post_subcategory extends Migration
{
    public function safeUp()
    {
        $table = '{{%post}}';
        $tableName = $this->db->schema->getRawTableName($table);
        $schema = $this->db->schema->getTableSchema($table, true);

        // 1) Add column if not exists
        if (!isset($schema->columns['subcategoryId'])) {
            $this->addColumn($table, 'subcategoryId', $this->integer()->null());
        }

        // 2) Create index if not exists
        $indexName = 'idx_post_subcategory';
        if ($this->db->driverName === 'sqlite') {
            // check via PRAGMA for SQLite
            $indexes = $this->db->createCommand("PRAGMA index_list('{$tableName}')")->queryAll();
            $hasIdx = false;
            foreach ($indexes as $idx) {
                if (isset($idx['name']) && $idx['name'] === $indexName) {
                    $hasIdx = true;
                    break;
                }
            }
            if (!$hasIdx) {
                $this->createIndex($indexName, $table, 'subcategoryId');
            }
        } else {
            // other drivers: attempt to create; if it already exists, most drivers will ignore or you can wrap in try/catch
            $this->createIndex($indexName, $table, 'subcategoryId');
        }

        // 3) Add FK except on SQLite (not supported via ALTER TABLE)
        if ($this->db->driverName !== 'sqlite') {
            $this->addForeignKey(
                'fk_post_subcategory',
                $table,
                'subcategoryId',
                '{{%blog_subcategories}}',
                'id',
                'SET NULL',
                'CASCADE'
            );
        }
    }

    public function safeDown()
    {
        $table = '{{%post}}';

        if ($this->db->driverName !== 'sqlite') {
            // Only drop FK if we created it
            $this->dropForeignKey('fk_post_subcategory', $table);
        }

        // Drop index if present (safe to attempt)
        try { $this->dropIndex('idx_post_subcategory', $table); } catch (\Throwable $e) {}

        // Dropping a column is supported on modern SQLite; if not, you can no-op here
        try { $this->dropColumn($table, 'subcategoryId'); } catch (\Throwable $e) {}
    }
}
