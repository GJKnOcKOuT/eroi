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
class m170721_111144_add_attachments_refs extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('attach_file_refs', [
            'id' => Schema::TYPE_PK,
            'hash' => Schema::TYPE_STRING . ' NOT NULL',
            'attach_file_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'model' => Schema::TYPE_STRING . ' NOT NULL',
            'item_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'attribute' => Schema::TYPE_STRING . ' NOT NULL',
            'crop' => Schema::TYPE_STRING,
            'date_upload' => Schema::TYPE_INTEGER . ' DEFAULT NULL',
            'is_main' => Schema::TYPE_BOOLEAN . ' DEFAULT 0',
            'sort' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',
        ]);

        $this->createIndex('attach_file_refs_hash', 'attach_file_refs', 'hash');
        $this->createIndex('attach_file_refs_item', 'attach_file_refs', 'item_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('attach_file_refs');
    }
}
