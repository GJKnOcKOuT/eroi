<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\attachments
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m150127_040544_add_attachments
 */
class m150127_040544_add_attachments extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('attach_file', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'model' => Schema::TYPE_STRING . ' NOT NULL',
            'attribute' => Schema::TYPE_STRING . ' NOT NULL',
            'itemId' => Schema::TYPE_INTEGER . ' NOT NULL',
            'hash' => Schema::TYPE_STRING . ' NOT NULL',
            'size' => Schema::TYPE_INTEGER . ' NOT NULL',
            'type' => Schema::TYPE_STRING . ' NOT NULL',
            'mime' => Schema::TYPE_STRING . ' NOT NULL',
            'is_main' => Schema::TYPE_BOOLEAN . ' DEFAULT 0',
            'date_upload' => Schema::TYPE_INTEGER . ' DEFAULT NULL',
            'sort' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1'
        ]);

        $this->createIndex('file_model', 'attach_file', 'model');
        $this->createIndex('file_item_id', 'attach_file', 'itemId');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('attach_file');
    }
}
