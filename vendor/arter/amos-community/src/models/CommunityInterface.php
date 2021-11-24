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
 * @package    arter\amos\community\models
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\community\models;

/**
 * Class CommunityInterface
 *
 * @property \arter\amos\community\models\Community $community
 * @property int $communityId
 *
 * @package arter\amos\community\models
 */
interface CommunityInterface
{
    /**
     * This method return the ActiveQuery to search the model related community.
     * @return \yii\db\ActiveQuery
     */
    public function getCommunity();
    
    /**
     * Getter method for community_id field.
     * @return int
     */
    public function getCommunityId();
    
    /**
     * Setter method for community_id field.
     * @param int $communityId
     */
    public function setCommunityId($communityId);
}
