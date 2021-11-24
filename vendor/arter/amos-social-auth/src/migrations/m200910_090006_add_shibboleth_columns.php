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

class m200910_090006_add_shibboleth_columns extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%social_idm_user}}', 'accessMethod', \yii\db\Schema::TYPE_STRING);
        $this->addColumn('{{%social_idm_user}}', 'accessLevel', \yii\db\Schema::TYPE_STRING);
    }

    public function safeDown()
    {
        $this->dropColumn('{{%social_idm_user}}', 'accessMethod');
        $this->dropColumn('{{%social_idm_user}}', 'accessLevel');

        return true;
    }
}
