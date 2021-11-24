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
 * @package    arter\amos\admin\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationWidgets;
use arter\amos\dashboard\models\AmosWidgets;

/**
 * Class m170630_102507_add_new_admin_widgets
 */
class m170630_102507_add_new_admin_widgets extends AmosMigrationWidgets
{
    const MODULE_NAME = 'admin';
    
    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \arter\amos\admin\widgets\graphics\WidgetGraphicMyProfile::className(),
                'type' => AmosWidgets::TYPE_GRAPHIC,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'default_order' => 1,
                'update' => true,
                'dontRemove' => true
            ],
            [
                'classname' => \arter\amos\admin\widgets\icons\WidgetIconMyProfile::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'default_order' => 1,
                'update' => true,
                'dontRemove' => true
            ],
            [
                'classname' => \arter\amos\admin\widgets\icons\WidgetIconAdmin::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'default_order' => 1
            ],
            [
                'classname' => \arter\amos\admin\widgets\icons\WidgetIconValidatedUserProfiles::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\admin\widgets\icons\WidgetIconAdmin::className(),
                'default_order' => 10
            ],
            [
                'classname' => \arter\amos\admin\widgets\icons\WidgetIconUserProfile::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\admin\widgets\icons\WidgetIconAdmin::className(),
                'default_order' => 20,
                'update' => true,
                'dontRemove' => true
            ],
            [
                'classname' => \arter\amos\admin\widgets\icons\WidgetIconCommunityManagerUserProfiles::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\admin\widgets\icons\WidgetIconAdmin::className(),
                'default_order' => 30
            ],
            [
                'classname' => \arter\amos\admin\widgets\icons\WidgetIconFacilitatorUserProfiles::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\admin\widgets\icons\WidgetIconAdmin::className(),
                'default_order' => 40
            ],
            [
                'classname' => \arter\amos\admin\widgets\icons\WidgetIconInactiveUserProfiles::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\admin\widgets\icons\WidgetIconAdmin::className(),
                'default_order' => 50
            ]
        ];
    }
}
