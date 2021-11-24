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


class m161209_084651_permissions_sondaggi_risposte_predefinite extends \yii\db\Migration
{

    const TABLE_PERMISSION = '{{%auth_item}}';

    public function safeUp()
    {
        $this->insert(self::TABLE_PERMISSION, [
            'name' => 'SONDAGGIRISPOSTEPREDEFINITE_CREATE',
            'type' => '2',
            'description' => 'Permesso di CREATE sul model SONDAGGIRISPOSTEPREDEFINITE'
        ]);
        $this->insert(self::TABLE_PERMISSION, [
            'name' => 'SONDAGGIRISPOSTEPREDEFINITE_DELETE',
            'type' => '2',
            'description' => 'Permesso di DELETE sul model SONDAGGIRISPOSTEPREDEFINITE'
        ]);
        $this->insert(self::TABLE_PERMISSION, [
            'name' => 'SONDAGGIRISPOSTEPREDEFINITE_READ',
            'type' => '2',
            'description' => 'Permesso di READ sul model SONDAGGIRISPOSTEPREDEFINITE'
        ]);
        $this->insert(self::TABLE_PERMISSION, [
            'name' => 'SONDAGGIRISPOSTEPREDEFINITE_UPDATE',
            'type' => '2',
            'description' => 'Permesso di UPDATE sul model SONDAGGIRISPOSTEPREDEFINITE'
        ]);                         
    }

    public function safeDown()
    {
        echo "Down() non previsto per il file m161209_084651_permissions_sondaggi_risposte_predefinite";
        return false;
    }

}