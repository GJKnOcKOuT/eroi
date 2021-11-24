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
use yii\db\Schema;

/**
 * Class m150128_160611_add_num_downloads
 */
class m150128_160611_add_num_downloads extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        if (!$this->db->getTableSchema('attach_file')->getColumn('num_downloads')) {
            $this->addColumn('attach_file', 'num_downloads', Schema::TYPE_INTEGER . " DEFAULT 0");
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        if (!$this->db->getTableSchema('attach_file')->getColumn('num_downloads')) {
            $this->dropColumn('attach_file', 'num_downloads');
        }

        return true;
    }
}
