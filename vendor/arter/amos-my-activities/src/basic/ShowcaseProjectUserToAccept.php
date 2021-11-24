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
use arter\amos\showcaseprojects\models\search\ShowcaseProjectSearch;
use arter\amos\showcaseprojects\models\search\ShowcaseProjectUserMmSearch;
use arter\amos\showcaseprojects\models\ShowcaseProject;
use yii\helpers\Url;

/**
 * Class ShowcaseProjectUserToAccept
 * @package arter\amos\myactivities\basic
 */
class ShowcaseProjectUserToAccept extends ShowcaseProjectUserMmSearch implements MyActivitiesModelsInterface
{
    /**
     * @return string
     */
    public function getSearchString()
    {
        return $this->showcaseProject->title;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        pr($this->created_at);die();
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
        /** @var UserProfile $userProfile*/
        $userProfile = UserProfile::find()->andWhere(['user_id' => $this->created_by])->one();
        if (!empty($userProfile)) {
            return $userProfile->getNomeCognome();
        }
        return '';
    }

    /**
     * @return ShowcaseProject
     */
    public function getWrappedObject()
    {
        return ShowcaseProject::findOne($this->showcase_project_id);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getViewUrl()
    {
        return '/showcaseprojects/showcase-project/view';
    }

    /**
     * @inheritdoc
     */
    public function getFullViewUrl()
    {
        return Url::toRoute(["/" . $this->getViewUrl(), "id" => $this->showcase_project_id]);
    }
}
