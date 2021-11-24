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
 * @package    arter\amos\utility\drivers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\utility\drivers;

use arter\amos\admin\models\UserContact;
use arter\amos\organizzazioni\models\ProfiloSedi;
use arter\amos\partnershipprofiles\models\PartnershipProfiles;
use arter\amos\admin\models\base\UserProfile;
use arter\amos\myactivities\basic\WaitingContacts;
use arter\amos\myactivities\basic\NewsToValidate;
use arter\amos\myactivities\basic\CommunityToValidate;
use arter\amos\myactivities\basic\RequestToParticipateCommunity;
use arter\amos\myactivities\basic\RequestToParticipateCommunityForManager;
use arter\amos\myactivities\basic\DiscussionToValidate;
use arter\amos\myactivities\basic\DocumentToValidate;
use arter\amos\myactivities\basic\EenExpressionOfInterestToTakeover;
use arter\amos\myactivities\basic\EventToValidate;
use arter\amos\myactivities\basic\ExpressionOfInterestToEvaluate;
use arter\amos\myactivities\basic\RequestExternalFacilitator;
use arter\amos\myactivities\basic\OrganizationsToValidate;
use arter\amos\myactivities\basic\PartnershipProfileToValidate;
use arter\amos\myactivities\basic\ReportToRead;
use arter\amos\myactivities\basic\RequestToJoinOrganizzazioniForReferees;
use arter\amos\myactivities\basic\RequestToJoinOrganizzazioniSediForReferees;
use arter\amos\myactivities\basic\ResultsProposalToValidate;
use arter\amos\myactivities\basic\ResultsToValidate;
use arter\amos\myactivities\basic\ShowcaseProjectToValidate;
use arter\amos\myactivities\basic\ShowcaseProjectUserToAccept;
use arter\amos\myactivities\basic\UserProfileActivationRequest;
use arter\amos\myactivities\basic\UserProfileToValidate;
use arter\amos\utility\drivers\base\bcDriver;
use arter\amos\myactivities\models\MyActivities;
use arter\amos\cwh\query\CwhActiveQuery;
use arter\amos\utility\models\BulletCounters;
use arter\amos\myactivities\models\search\MyActivitiesModelSearch;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * 
 */
class bcDriverMyActivities extends bcDriver
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->modelClassName  = MyActivities::className(); // put here your model
        $this->widgetIconNames = [
            'WidgetIconMyActivities' => 'arter\amos\myactivities\widgets\icons\WidgetIconMyActivities',
        ];

        $this->counter = 0;
    }

    /**
     * @inheritdoc
     */
    public function calculateBulletCounters()
    {
        $myActivitiesModule = \Yii::$app->getModule('myactivities');
        $count = \arter\amos\myactivities\models\MyActivities::getCountActivities(true);

        $this->updateBulletCountersTable(
            $this->user_id, 'myactivities', 'arter\amos\myactivities\widgets\icons\WidgetIconMyActivities',
            $count, true
        );
    }
}