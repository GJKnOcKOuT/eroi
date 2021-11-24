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
 * @package    arter\amos\chat
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;

class m161026_140628_update_amoschat_role extends Migration
{
    const TABLE_AUTH_ITEM = '{{%auth_item}}';
    const TABLE_AUTH_ITEM_CHILD = '{{%auth_item_child}}';

    /**
     * Use this instead of function up().
     * @see \Yii\db\Migration::safeUp() for more info.
     */
    public function safeUp()
    {
        try {
            $this->execute("SET foreign_key_checks = 0;");
            $this->update('tag_models_auth_items_mm', ['auth_item' => 'AMMINISTRATORE_CHAT'] , ['auth_item' => 'AMMINISRATORE_CHAT']);
            $this->update(self::TABLE_AUTH_ITEM, ['name' => 'AMMINISTRATORE_CHAT'] , ['name' => 'AMMINISRATORE_CHAT']);
            $this->update(self::TABLE_AUTH_ITEM_CHILD, ['parent' => 'AMMINISTRATORE_CHAT'] , ['parent' => 'AMMINISRATORE_CHAT']);
            $this->update(self::TABLE_AUTH_ITEM_CHILD, ['child' => 'AMMINISTRATORE_CHAT'] , ['child' => 'AMMINISRATORE_CHAT']);
            $this->execute("SET foreign_key_checks = 1;");
        } catch (Exception $e) {
            echo $e->getMessage() . "\n";
            return false;
        }

        return true;
    }

    /**
     * Use this instead of function down().
     * @see \Yii\db\Migration::safeDown() for more info.
     */
    public function safeDown()
    {
        echo "Down non esegue nessuna operazione.";
        return true;
    }
}
