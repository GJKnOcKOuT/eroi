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
 * @package    arter\amos\community\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\community\AmosCommunity;
use arter\amos\community\models\Community;
use arter\amos\community\models\CommunityUserMm;
use arter\amos\community\utilities\CommunityUtil;
use arter\amos\core\migration\libs\common\MigrationCommon;
use yii\db\ActiveQuery;
use yii\db\Migration;

/**
 * Class m191128_122304_auto_add_community_managers_to_configured_roles
 */
class m191128_122304_auto_add_community_managers_to_configured_roles extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        // Time limit to 8 hours
        set_time_limit(8 * 60 * 60);
        ini_set('memory_limit', '4096M');
        
        $className = 'm191128_122304_auto_add_community_managers_to_configured_roles';
        $communityModule = AmosCommunity::instance();
        if (!is_null($communityModule)) {
            $autoCommunityManagerRoles = $communityModule->autoCommunityManagerRoles;
            if (is_array($autoCommunityManagerRoles)) {
                if (!empty($autoCommunityManagerRoles)) {
                    /** @var ActiveQuery $query */
                    $query = Community::find();
                    $allCommunities = $query->all();
                    foreach ($allCommunities as $community) {
                        /** @var Community $community */
                        $ok = CommunityUtil::autoAddCommunityManagersToCommunity($community, CommunityUserMm::STATUS_ACTIVE, $communityModule);
                        if (!$ok) {
                            MigrationCommon::printConsoleMessage('Errore aggiunta dei community manager alla community con ID "' . $community->id . '"');;
                        }
                    }
                } else {
                    MigrationCommon::printConsoleMessage($className . ': autoCommunityManagerRoles vuoto.');
                }
            } else {
                MigrationCommon::printConsoleMessage($className . ': autoCommunityManagerRoles non è un array.');
            }
        } else {
            MigrationCommon::printConsoleMessage($className . ': modulo community non configurato. Nulla da fare.');
        }
        return true;
    }
    
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m191128_122304_auto_add_community_managers_to_configured_roles cannot be reverted.\n";
        return false;
    }
}
