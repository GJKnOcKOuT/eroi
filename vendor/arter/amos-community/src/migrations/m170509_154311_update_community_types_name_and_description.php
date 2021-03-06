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
 * @package    arter\amos\community
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\community\models\CommunityType;

/**
 * Class m170509_154311_update_community_types_name_and_description
 */
class m170509_154311_update_community_types_name_and_description extends \yii\db\Migration
{

    const COMMUNITY_TYPES_TABLE = 'community_types';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $rowsToUpdate = Array(
            ['id' => CommunityType::COMMUNITY_TYPE_OPEN, 'name' => 'Open', 'description' => 'An open community is visible to everyone and it is possible to join it without sending any authorization request'],
            ['id' => CommunityType::COMMUNITY_TYPE_PRIVATE, 'name' => 'Reserved', 'description' => 'A private community is visible to everyone but it is possible to sign into it only after the subscription request acceptance of the Community Manager'],
            ['id' => CommunityType::COMMUNITY_TYPE_CLOSED, 'name' => 'Limited to members', 'description' => 'A community limited to members is not visible to everyone and it is possible to sign into it only on Community Manager invitation, when the invitation is accepted by the user']
        );

        foreach ($rowsToUpdate as $row){
            $communityType = CommunityType::findOne($row['id']);
            $communityType->name = $row['name'];
            $communityType->description = $row['description'];
            $communityType->detachBehaviors();
            $communityType->save(false);
        }
        return true;
    }

    public function safeDown()
    {
        $rowsToUpdate = Array(
            ['id' => CommunityType::COMMUNITY_TYPE_OPEN, 'name' => 'Aperta', 'description' => 'Una community aperta ?? visibile a tutti e vi ci si pu?? iscrivere liberamente senza richieste di autorizzazione.'],
            ['id' => CommunityType::COMMUNITY_TYPE_PRIVATE, 'name' => 'Riservata', 'description' => 'Una community riservata ?? visibile a tutti ma vi ci si pu?? accedere solo in seguito all\'acettazione della richiesta di iscrizione da parte del Community Manager.'],
            ['id' => CommunityType::COMMUNITY_TYPE_CLOSED, 'name' => 'Chiusa', 'description' => 'Una community chiusa non ?? visibile a tutti e vi ci si pu?? accedere solo su invito del Community Manager quando l\'invito viene accettato dall\'utente).']
        );

        foreach ($rowsToUpdate as $row){
            $communityType = CommunityType::findOne($row['id']);
            $communityType->name = $row['name'];
            $communityType->description = $row['description'];
            $communityType->detachBehaviors();
            $communityType->save(false);
        }
        return true;
    }
}
