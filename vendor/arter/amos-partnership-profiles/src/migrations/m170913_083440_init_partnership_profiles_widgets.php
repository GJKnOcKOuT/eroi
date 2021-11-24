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

use arter\amos\core\migration\AmosMigrationWidgets;
use arter\amos\dashboard\models\AmosWidgets;
use yii\helpers\ArrayHelper;

/**
 * Class m170913_083440_init_partnership_profiles_widgets
 */
class m170913_083440_init_partnership_profiles_widgets extends AmosMigrationWidgets
{
    const PARTNERSHIPPROFILESADMIN = 'partnershipprofilesadmin';
    const PARTNERSHIPPROFILES = 'partnershipprofiles';
    const EXPRESSIONSOFINTEREST = 'expressionsofinterest';
    const PARTNERPROFEXPROFINT = 'partnerprofexprofint';

    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = ArrayHelper::merge(
            $this->partnershipProfilesWidgets(),
            $this->expressionsOfInterestWidgets(),
            $this->partnerProfExprOfIntWidgets()
        );
    }

    /**
     * @return array
     */
    private function partnershipProfilesWidgets()
    {
        return [
            [
                'classname' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesAllAdmin::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::PARTNERSHIPPROFILESADMIN,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => null,
                'dashboard_visible' => 1,
                'default_order' => 1
            ],
            [
                'classname' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesDashboard::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::PARTNERSHIPPROFILES,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => null,
                'dashboard_visible' => 1,
                'default_order' => 1
            ],
            [
                'classname' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesOwnInterest::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::PARTNERSHIPPROFILES,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesDashboard::className(),
                'dashboard_visible' => 0,
                'default_order' => 10
            ],
            [
                'classname' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesAll::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::PARTNERSHIPPROFILES,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesDashboard::className(),
                'dashboard_visible' => 0,
                'default_order' => 20
            ],
            [
                'classname' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesCreatedBy::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::PARTNERSHIPPROFILES,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesDashboard::className(),
                'dashboard_visible' => 0,
                'default_order' => 30
            ],
            [
                'classname' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesToValidate::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::PARTNERSHIPPROFILES,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesDashboard::className(),
                'dashboard_visible' => 0,
                'default_order' => 40
            ],
            [
                'classname' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesArchived::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::PARTNERSHIPPROFILES,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesDashboard::className(),
                'dashboard_visible' => 0,
                'default_order' => 50
            ],
            [
                'classname' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesClosed::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::PARTNERSHIPPROFILES,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesDashboard::className(),
                'dashboard_visible' => 0,
                'default_order' => 60
            ]
        ];
    }

    /**
     * @return array
     */
    private function expressionsOfInterestWidgets()
    {
        return [
            [
                'classname' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconExpressionsOfInterestAllAdmin::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::EXPRESSIONSOFINTEREST,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => null,
                'dashboard_visible' => 1,
                'default_order' => 1
            ],
            [
                'classname' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconExpressionsOfInterestDashboard::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::EXPRESSIONSOFINTEREST,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => null,
                'dashboard_visible' => 1,
                'default_order' => 1
            ],
            [
                'classname' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconExpressionsOfInterestReceived::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::EXPRESSIONSOFINTEREST,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconExpressionsOfInterestDashboard::className(),
                'dashboard_visible' => 0,
                'default_order' => 10
            ],
            [
                'classname' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconExpressionsOfInterestCreatedBy::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::EXPRESSIONSOFINTEREST,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconExpressionsOfInterestDashboard::className(),
                'dashboard_visible' => 0,
                'default_order' => 20
            ]
        ];
    }

    /**
     * @return array
     */
    private function partnerProfExprOfIntWidgets()
    {
        return [
            [
                'classname' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnerProfExprOfIntDashboard::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::PARTNERPROFEXPROFINT,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => null,
                'dashboard_visible' => 1,
                'default_order' => 1
            ],
            [
                'classname' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnerProfExprOfIntPartProf::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::PARTNERPROFEXPROFINT,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnerProfExprOfIntDashboard::className(),
                'dashboard_visible' => 0,
                'default_order' => 10
            ],
            [
                'classname' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnerProfExprOfIntExprOfInt::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::PARTNERPROFEXPROFINT,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnerProfExprOfIntDashboard::className(),
                'dashboard_visible' => 0,
                'default_order' => 20
            ]
        ];
    }
}
