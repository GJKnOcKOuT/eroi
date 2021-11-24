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
 * @package    arter\amos\partnershipprofiles\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\libs\common\MigrationCommon;
use arter\amos\partnershipprofiles\models\PartnershipProfiles;
use yii\db\Migration;

/**
 * Class m171201_115022_add_partnership_profiles_field_community_id
 */
class m171201_115022_add_partnership_profiles_field_community_id extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn(PartnershipProfiles::tableName(), 'community_id', $this->integer()->null()->after('intellectual_property_id')->comment('Community ID'));
        MigrationCommon::printConsoleMessage('Added partnership profiles field: community_id');
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn(PartnershipProfiles::tableName(), 'community_id');
        MigrationCommon::printConsoleMessage('Removed partnership profiles field: community_id');
        return true;
    }
}
