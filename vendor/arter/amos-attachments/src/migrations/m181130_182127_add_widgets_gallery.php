<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationWidgets;
use arter\amos\dashboard\models\AmosWidgets;


/**
* Class m180327_162827_add_amos_widgets_een_archived*/
class m181130_182127_add_widgets_gallery extends AmosMigrationWidgets
{
    const MODULE_NAME = 'attachments';

    /**
    * @inheritdoc
    */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \arter\amos\attachments\widgets\icons\WidgetIconGalleryDashboard::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'dashboard_visible' => 0,
                'default_order' => 70,
                'child_of' =>  \arter\amos\dashboard\widgets\icons\WidgetIconManagement::className(),
            ],
            [
                'classname' => \arter\amos\attachments\widgets\icons\WidgetIconGallery::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'dashboard_visible' => 0,
                'default_order' => 10,
                'child_of' =>  \arter\amos\attachments\widgets\icons\WidgetIconGalleryDashboard::className(),
            ],
            [
                'classname' => \arter\amos\attachments\widgets\icons\WidgetIconCategory::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'dashboard_visible' => 0,
                'default_order' => 20,
                'child_of' =>  \arter\amos\attachments\widgets\icons\WidgetIconGalleryDashboard::className(),
            ],

        ];
    }
}
