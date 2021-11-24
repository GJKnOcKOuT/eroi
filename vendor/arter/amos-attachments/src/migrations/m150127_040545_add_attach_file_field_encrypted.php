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
 * @package    arter\amos\attachments\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;

/**
 * Class m191118_222733_add_attach_file_field_encrypted
 */
class m150127_040545_add_attach_file_field_encrypted extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        if(!$this->db->getTableSchema('attach_file')->getColumn('encrypted')) {
            $this->addColumn('attach_file', 'encrypted', $this->boolean()->notNull()->defaultValue(0));
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        if($this->db->getTableSchema('attach_file')->getColumn('encrypted')) {
            $this->dropColumn('attach_file', 'encrypted');
        }

        return true;
    }
}
