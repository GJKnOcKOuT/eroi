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

class m150802_000002_insert_faq_stato extends \yii\db\Migration {

    const TABLE = '{{%faq_stato}}';

    public function safeUp() {
        $this->insert(self::TABLE, [
            'id' => '1',
            'nome' => 'BOZZA',
            'descrizione' => 'Modifica in corso'
        ]);

        $this->insert(self::TABLE, [
            'id' => '2',
            'nome' => 'DA_VALIDARE',
            'descrizione' => 'Da validare'
        ]);

        $this->insert(self::TABLE, [
            'id' => '3',
            'nome' => 'VALIDATO',
            'descrizione' => 'Validato'
        ]);

        $this->insert(self::TABLE, [
            'id' => '4',
            'nome' => 'NON_VALIDATO',
            'descrizione' => 'Non validato'
        ]);
    }

    public function safeDown() {
        $this->delete(self::TABLE, ['id' => '1']);
        $this->delete(self::TABLE, ['id' => '2']);
        $this->delete(self::TABLE, ['id' => '3']);
        $this->delete(self::TABLE, ['id' => '4']);
    }

}
