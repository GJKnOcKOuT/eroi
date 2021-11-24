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

class m150802_000004_insert_faq_categories extends \yii\db\Migration {

    const TABLE = '{{%faq_categories}}';

    public function safeUp() {
        $this->insert(self::TABLE, [
            'id' => '1',
            'titolo' => 'Widget grafici',
            'descrizione' => ''
        ]);

        $this->insert(self::TABLE, [
            'id' => '2',
            'titolo' => 'WIdget a icona',
            'descrizione' => ''
        ]);
    }

    public function safeDown() {
        $this->execute("SET FOREIGN_KEY_CHECKS = 0;");
        $this->delete(self::TABLE, ['id' => '1']);
        $this->delete(self::TABLE, ['id' => '2']);
        $this->execute("SET FOREIGN_KEY_CHECKS = 1;");
    }

}
