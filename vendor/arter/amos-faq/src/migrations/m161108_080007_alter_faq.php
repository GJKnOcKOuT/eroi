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
 * @package    arter\amos\faq
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Schema;

class m161108_080007_alter_faq extends \yii\db\Migration {

    const TABLE = '{{%faq}}';

    public function safeUp() {
        if ($this->db->schema->getTableSchema(self::TABLE, true) !== null) {           
            $this->dropForeignKey('fk_faq_faq_widgets1', self::TABLE);
            $this->dropIndex('fk_faq_faq_widgets1', self::TABLE);
            $this->dropColumn(self::TABLE, 'faq_widgets_id');                     
        } else {
            echo "Nessuna operazion eseguita in quanto la tabella non esiste";
            return true;
        }
    }

    public function safeDown() {
        echo "Nessuna cancellazione eseguita";
        return true;
    }

}
