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
* Class m200131_173328_add_amos_widgets_latest_partnership_profiles_animator*/
class m200131_173328_add_amos_widgets_latest_partnership_profiles_animator extends AmosMigrationWidgets
{
    const MODULE_NAME = 'partnershipprofiles';

    /**
    * @inheritdoc
    */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \backend\modules\aster_partnership_profiles\widget\graphics\WidgetGraphicsLatestPartnershipProfilesAnimator::className(),
                'type' => AmosWidgets::TYPE_GRAPHIC ,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => null,
                'dashboard_visible' => 1,
                'default_order' => 20
            ],
        ];
    }
}
