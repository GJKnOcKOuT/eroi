<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\platform\common\console\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationWidgets;
use arter\amos\dashboard\models\AmosWidgets;


/**
* Class m180327_162827_add_amos_widgets_een_archived*/
class m200115_104130_add_amos_widgets_animation_sfide extends AmosMigrationWidgets
{
    const MODULE_NAME = 'partnershipprofiles';

    /**
    * @inheritdoc
    */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' =>  \backend\modules\aster_partnership_profiles\widget\icons\AnimazioneSfideWidgetIcon::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'dashboard_visible' => 0,
                'default_order' => 31,
                'child_of' => arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesDashboardGeneral::className(),

            ],
            [
                'classname' =>  \backend\modules\aster_partnership_profiles\widget\icons\AnimazioneSfideToValidateWidgetIcon::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'dashboard_visible' => 0,
                'default_order' => 1,
                'child_of' => \backend\modules\aster_partnership_profiles\widget\icons\AnimazioneSfideWidgetIcon::className(),

            ],
            [
                'classname' =>  \backend\modules\aster_partnership_profiles\widget\icons\AnimazioneSfidePublishedWidgetIcon::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'dashboard_visible' => 0,
                'default_order' => 2,
                'child_of' => \backend\modules\aster_partnership_profiles\widget\icons\AnimazioneSfideWidgetIcon::className(),

            ],
            [
                'classname' =>  \backend\modules\aster_partnership_profiles\widget\icons\AnimazioneSfideToAssignWidgetIcon::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'dashboard_visible' => 0,
                'default_order' => 3,
                'child_of' => \backend\modules\aster_partnership_profiles\widget\icons\AnimazioneSfideWidgetIcon::className(),

            ],
            [
                'classname' =>  \backend\modules\aster_partnership_profiles\widget\icons\AnimazioneSfideAssignedWidgetIcon::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'dashboard_visible' => 0,
                'default_order' => 4,
                'child_of' => \backend\modules\aster_partnership_profiles\widget\icons\AnimazioneSfideWidgetIcon::className(),

            ],
        ];
    }
}
