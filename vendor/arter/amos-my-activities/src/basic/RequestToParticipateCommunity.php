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
 * @package    arter\amos\myactivities\basic
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\myactivities\basic;

use arter\amos\admin\models\UserProfile;

/**
 * Class RequestToParticipateCommunity
 * @see \arter\amos\community\models\Community
 * @package arter\amos\myactivities\basic
 */
class RequestToParticipateCommunity extends \arter\amos\community\models\CommunityUserMm implements MyActivitiesModelsInterface
{
    /**
     * @return string
     */
    public function getSearchString()
    {
        return $this->getCreatorNameSurname();
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function getCreatorNameSurname()
    {
        /** @var UserProfile $userProfile */
        $userProfile = UserProfile::find()->andWhere(['user_id' => $this->created_by])->one();
        if (!empty($userProfile)) {
            return $userProfile->getNomeCognome();
        }
        return '';
    }

    /**
     * @return \arter\amos\community\models\CommunityUserMm
     */
    public function getWrappedObject()
    {
        return \arter\amos\community\models\CommunityUserMm::findOne($this->id);
    }
}
