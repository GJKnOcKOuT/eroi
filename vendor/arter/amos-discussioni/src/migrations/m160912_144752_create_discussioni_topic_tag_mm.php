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
 * @package    arter\amos\discussioni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;
use yii\db\Schema;

class m160912_144752_create_discussioni_topic_tag_mm extends Migration
{
    const TABLE = '{{%discussioni_topic_tag_mm}}';
    const TABLE_TAG = '{{%tag}}';
    
    public function safeUp()
    {
        if ($this->db->schema->getTableSchema(self::TABLE, true) === null)
        {
            if ($this->db->schema->getTableSchema(self::TABLE_TAG, true) === null)
            {
                echo "Nessuna creazione eseguita in quanto il modulo TAG sembrerebbe non installato";
                return false;
            }
            else
            {
                $this->createTable(self::TABLE, [
                    'discussioni_topic_id' => Schema::TYPE_INTEGER . " NOT NULL",
                    'tag_id' => Schema::TYPE_INTEGER . " NOT NULL"
                ], $this->db->driverName === 'mysql' ? 'ENGINE=InnoDB' : null);
                $this->addForeignKey('fk_discussioni_topic_has_tag_discussioni_topic1', self::TABLE, 'discussioni_topic_id', 'discussioni_topic', 'id');
                $this->addForeignKey('fk_discussioni_topic_has_tag_tag1', self::TABLE, 'tag_id', 'tag', 'id');
            }
        }
        else
        {
            echo "Nessuna creazione eseguita in quanto la tabella esiste già";
        }
        
        return true;
    }
    
    public function safeDown()
    {
        if ($this->db->schema->getTableSchema(self::TABLE, true) !== null)
        {
            $this->dropForeignKey('fk_discussioni_topic_has_tag_tag1', self::TABLE);
            $this->dropForeignKey('fk_discussioni_topic_has_tag_discussioni_topic1', self::TABLE);
            $this->dropTable(self::TABLE);
        }
        else
        {
            echo "Nessuna cancellazione eseguita in quanto la tabella non esiste";
        }
        
        return true;
    }
}
