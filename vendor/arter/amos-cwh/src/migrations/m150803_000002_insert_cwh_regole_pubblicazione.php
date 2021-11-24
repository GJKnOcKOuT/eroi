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
 * @package    arter\amos\cwh
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

class m150803_000002_insert_cwh_regole_pubblicazione extends \yii\db\Migration
{

    const TABLE = '{{%cwh_regole_pubblicazione}}';

    public function safeUp()
    {
        $this->insert(self::TABLE, [
            'id' => '1',
            'nome' => 'Tutti gli utenti',
            'codice' => 'PUBLIC'
        ]);
        $this->insert(self::TABLE, [
            'id' => '2',
            'nome' => 'Tutti gli utenti in base ai loro interessi',
            'codice' => 'PUBLIC_TAG'
        ]);
        $this->insert(self::TABLE, [
            'id' => '3',
            'nome' => 'Tutti utenti della rete indicata',
            'codice' => 'NETWORK'
        ]);
        $this->insert(self::TABLE, [
            'id' => '4',
            'nome' => 'Tutti gli utenti della rete indicata in base ai loro interessi',
            'codice' => 'NETWORK_TAG'
        ]);

    }

    public function safeDown()
    {
        $this->delete(self::TABLE, ['id' => '1']);
        $this->delete(self::TABLE, ['id' => '2']);
        $this->delete(self::TABLE, ['id' => '3']);
        $this->delete(self::TABLE, ['id' => '4']);
    }

}