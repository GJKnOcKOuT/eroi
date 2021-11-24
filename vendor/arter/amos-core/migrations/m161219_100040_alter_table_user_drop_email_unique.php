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
 * @package    arter\amos\core\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;

class m161219_100040_alter_table_user_drop_email_unique extends Migration
{
    public function safeUp()
    {
        try {
            $this->dropIndex('email','user');
            //$this->db->createCommand()->setSql("ALTER TABLE user DROP INDEX IF EXISTS email")->execute();
        } catch (Exception $exception) {
            echo "Rimozione indice unique su campo email tabella user fallita\n";
            echo $exception->getMessage();
            echo "\n";
        }
        return true;
    }

    public function safeDown()
    {
        try {
            $this->createIndex('email', 'user', 'email',ture);
            //$this->db->createCommand()->setSql("ALTER TABLE user ADD UNIQUE IF NOT EXISTS(email)")->execute();
        } catch (Exception $exception) {
            echo "Aggiunta indice unique su campo email tabella user fallita\n";
            echo $exception->getMessage();
            echo "\n";
        }
        return true;
    }
}
