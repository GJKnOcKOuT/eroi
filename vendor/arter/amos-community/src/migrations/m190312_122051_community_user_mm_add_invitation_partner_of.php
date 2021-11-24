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
 * Class m190312_122051_community_user_mm_add_invitation_partner_of
 */
class m190312_122051_community_user_mm_add_invitation_partner_of extends Migration
{

    public function up()
    {
        $this->addColumn('community_user_mm', 'invitation_partner_of', $this->integer()->null()->defaultValue(null)->after('invitation_accepted_at'));
    }

    public function down()
    {
        $this->dropColumn('community_user_mm', 'invitation_partner_of');
    }

}
