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

/**
 * Class m190207_130342_community_user_mm_add_invitation_fields
 */
class m190207_130342_community_user_mm_add_invitation_fields extends Migration
{

    public function up()
    {
        $this->addColumn('community_user_mm', 'invited_at', $this->dateTime()->null()->defaultValue(null)->after('role'));
        $this->addColumn('community_user_mm', 'invitation_accepted_at', $this->dateTime()->null()->defaultValue(null)->after('invited_at'));
    }

    public function down()
    {
        $this->dropColumn('community_user_mm', 'invited_at');
        $this->dropColumn('community_user_mm', 'invitation_accepted_at');
    }

}
