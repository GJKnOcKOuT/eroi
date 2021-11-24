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


class m161209_084648_permissions_sondaggi extends \yii\db\Migration
{

    const TABLE_PERMISSION = '{{%auth_item}}';

    public function safeUp()
    {
        $this->insert(self::TABLE_PERMISSION, [
            'name' => 'AMMINISTRAZIONE_SONDAGGI',
            'type' => '1',
            'description' => 'Ruolo di Amministratore dei sondaggi'
        ]);        
        $this->insert(self::TABLE_PERMISSION, [
            'name' => 'SONDAGGI_CREATE',
            'type' => '2',
            'description' => 'Permesso di CREATE sul model SONDAGGI'
        ]);
        $this->insert(self::TABLE_PERMISSION, [
            'name' => 'SONDAGGI_DELETE',
            'type' => '2',
            'description' => 'Permesso di DELETE sul model SONDAGGI'
        ]);
        $this->insert(self::TABLE_PERMISSION, [
            'name' => 'SONDAGGI_READ',
            'type' => '2',
            'description' => 'Permesso di READ sul model SONDAGGI'
        ]);
        $this->insert(self::TABLE_PERMISSION, [
            'name' => 'SONDAGGI_UPDATE',
            'type' => '2',
            'description' => 'Permesso di UPDATE sul model SONDAGGI'
        ]);                         
    }

    public function safeDown()
    {
        echo "Down() non previsto per il file m161209_084648_permissions_sondaggi";
        return false;
    }

}