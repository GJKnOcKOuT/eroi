<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


use yii\db\Migration;

class m170905_142740_add_index_notification extends Migration
{
    const TABLE = '{{%notification}}';
    const TABLE_READ = '{{%notificationread}}';

    public function safeUp()
    {
        if ($this->db->schema->getTableSchema(self::TABLE, true))
        {

            $this->createIndex("class_name", self::TABLE, ["class_name"]);
            $this->createIndex("channels", self::TABLE, ["channels"]);

        }
        else
        {
            echo "Nessuna creazione eseguita in quanto la tabella esiste gia'";
        }

        return true;
    }

    public function safeDown()
    {
        if ($this->db->schema->getTableSchema(self::TABLE, true) !== null)
        {
            $this->dropIndex('class_name',self::TABLE );
            $this->dropIndex('channels',self::TABLE );
        }
        else
        {
            echo "Nessuna cancellazione eseguita in quanto la tabella non esiste";
        }

        return true;
    }
}
