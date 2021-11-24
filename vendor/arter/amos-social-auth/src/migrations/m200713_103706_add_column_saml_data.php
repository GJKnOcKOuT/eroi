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

class m200713_103706_add_column_saml_data extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%social_idm_user}}', 'rawData', \yii\db\Schema::TYPE_TEXT);
    }

    public function safeDown()
    {
        $this->dropColumn('{{%social_idm_user}}', 'rawData');

        return true;
    }
}
