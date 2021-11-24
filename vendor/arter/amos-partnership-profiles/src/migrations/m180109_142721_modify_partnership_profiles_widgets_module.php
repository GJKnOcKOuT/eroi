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

use arter\amos\core\exceptions\MigrationsException;
use arter\amos\core\migration\AmosMigrationWidgets;
use arter\amos\dashboard\models\base\AmosWidgets;
use arter\amos\dashboard\utility\DashboardUtility;
use arter\amos\partnershipprofiles\base\PartnershipProfilesModules;
use arter\amos\partnershipprofiles\widgets\icons\WidgetIconExpressionsOfInterestAllAdmin;
use arter\amos\partnershipprofiles\widgets\icons\WidgetIconExpressionsOfInterestCreatedBy;
use arter\amos\partnershipprofiles\widgets\icons\WidgetIconExpressionsOfInterestDashboard;
use arter\amos\partnershipprofiles\widgets\icons\WidgetIconExpressionsOfInterestReceived;
use arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnerProfExprOfIntDashboard;
use arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnerProfExprOfIntExprOfInt;
use arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnerProfExprOfIntPartProf;
use arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesAllAdmin;

/**
 * Class m180109_142721_modify_partnership_profiles_widgets_module
 */
class m180109_142721_modify_partnership_profiles_widgets_module extends AmosMigrationWidgets
{
    /**
     * @throws MigrationsException
     */
    public function init()
    {
        parent::init();

        $modules = [
            PartnershipProfilesModules::PART_PROF_MODULE_NAME,
            PartnershipProfilesModules::PART_PROF_ADMIN_MODULE_NAME,
            PartnershipProfilesModules::EXPR_OF_INT_MODULE_NAME,
            PartnershipProfilesModules::EXPR_OF_INT_ADMIN_MODULE_NAME,
            PartnershipProfilesModules::PART_PROF_EXPR_OF_INT_MODULE_NAME
        ];

        foreach ($modules as $module) {
            $ok = DashboardUtility::resetDashboardsByModule($module);
            if (!$ok) {
                throw new MigrationsException('Errore durante il reset delle dashboard per il modulo ' . $module);
            }
        }
    }

    /**
     * @inheritdoc
     */
    protected function checkWidgetExist($widgetData, $classNameField)
    {
        $className = $widgetData[$classNameField];
        $condition = ['classname' => $className];
        $oldWidgets = AmosWidgets::findAll($condition);
        $countOldWidgets = count($oldWidgets);
        return ($countOldWidgets > 0);
    }

    /**
     * @inheritdoc
     */
    protected function updateExistentWidget($widgetData)
    {
        $condition = ['classname' => $widgetData['classname']];
        $widgetToUpdate = AmosWidgets::findOne($condition);
        $ok = $this->saveWidget($widgetData, $widgetToUpdate);
        return $ok;
    }
    
    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [

            // Partnership profiles admin widget
            [
                'classname' => WidgetIconPartnershipProfilesAllAdmin::className(),
                'update' => true,
                'module' => PartnershipProfilesModules::PART_PROF_MODULE_NAME
            ],

            // Expressions of interest widgets
            [
                'classname' => WidgetIconExpressionsOfInterestAllAdmin::className(),
                'update' => true,
                'module' => PartnershipProfilesModules::PART_PROF_MODULE_NAME
            ],
            [
                'classname' => WidgetIconExpressionsOfInterestDashboard::className(),
                'update' => true,
                'module' => PartnershipProfilesModules::PART_PROF_MODULE_NAME
            ],
            [
                'classname' => WidgetIconExpressionsOfInterestReceived::className(),
                'update' => true,
                'module' => PartnershipProfilesModules::PART_PROF_MODULE_NAME
            ],
            [
                'classname' => WidgetIconExpressionsOfInterestCreatedBy::className(),
                'update' => true,
                'module' => PartnershipProfilesModules::PART_PROF_MODULE_NAME
            ],

            // Partnership profiles and expressions of interest widgets
            [
                'classname' => WidgetIconPartnerProfExprOfIntDashboard::className(),
                'update' => true,
                'module' => PartnershipProfilesModules::PART_PROF_MODULE_NAME
            ],
            [
                'classname' => WidgetIconPartnerProfExprOfIntPartProf::className(),
                'update' => true,
                'module' => PartnershipProfilesModules::PART_PROF_MODULE_NAME
            ],
            [
                'classname' => WidgetIconPartnerProfExprOfIntExprOfInt::className(),
                'update' => true,
                'module' => PartnershipProfilesModules::PART_PROF_MODULE_NAME
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $oldWidgets = [

            // Partnership profiles admin widget
            [
                'classname' => WidgetIconPartnershipProfilesAllAdmin::className(),
                'update' => true,
                'module' => PartnershipProfilesModules::PART_PROF_ADMIN_MODULE_NAME
            ],

            // Expressions of interest widgets
            [
                'classname' => WidgetIconExpressionsOfInterestAllAdmin::className(),
                'update' => true,
                'module' => PartnershipProfilesModules::EXPR_OF_INT_MODULE_NAME
            ],
            [
                'classname' => WidgetIconExpressionsOfInterestDashboard::className(),
                'update' => true,
                'module' => PartnershipProfilesModules::EXPR_OF_INT_MODULE_NAME
            ],
            [
                'classname' => WidgetIconExpressionsOfInterestReceived::className(),
                'update' => true,
                'module' => PartnershipProfilesModules::EXPR_OF_INT_MODULE_NAME
            ],
            [
                'classname' => WidgetIconExpressionsOfInterestCreatedBy::className(),
                'update' => true,
                'module' => PartnershipProfilesModules::EXPR_OF_INT_MODULE_NAME
            ],

            // Partnership profiles and expressions of interest widgets
            [
                'classname' => WidgetIconPartnerProfExprOfIntDashboard::className(),
                'update' => true,
                'module' => PartnershipProfilesModules::PART_PROF_EXPR_OF_INT_MODULE_NAME
            ],
            [
                'classname' => WidgetIconPartnerProfExprOfIntPartProf::className(),
                'update' => true,
                'module' => PartnershipProfilesModules::PART_PROF_EXPR_OF_INT_MODULE_NAME
            ],
            [
                'classname' => WidgetIconPartnerProfExprOfIntExprOfInt::className(),
                'update' => true,
                'module' => PartnershipProfilesModules::PART_PROF_EXPR_OF_INT_MODULE_NAME
            ]
        ];

        $allOk = true;

        foreach ($oldWidgets as $widgetData) {
            $ok = $this->insertOrUpdateWidget($widgetData);
            if (!$ok) {
                $allOk = false;
            }
        }

        return $allOk;
    }
}
