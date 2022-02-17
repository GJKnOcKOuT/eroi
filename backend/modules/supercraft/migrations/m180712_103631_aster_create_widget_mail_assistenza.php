<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\tickets\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

class m180712_103631_aster_create_widget_mail_assistenza  extends \arter\amos\core\migration\AmosMigrationWidgets
{
    const MODULE_NAME = 'tickets';

    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \backend\modules\supercraft\widgets\icons\WidgetIconSupercraft::className(),
                'type' => \arter\amos\dashboard\models\AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'dashboard_visible' => 1,
                'status' => \arter\amos\dashboard\models\AmosWidgets::STATUS_ENABLED
            ]
        ];
    }
}
