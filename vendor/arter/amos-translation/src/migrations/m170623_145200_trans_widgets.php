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
 * @package    arter\amos\translation\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationWidgets;
use arter\amos\dashboard\models\AmosWidgets;

/**
 * Class m170623_145200_trans_widgets
 */
class m170623_145200_trans_widgets extends AmosMigrationWidgets
{
    const MODULE_NAME = 'translation';

    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \arter\amos\translation\widgets\icons\WidgetIconTranslation::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => null,
                'default_order' => 10
            ],
            [
                'classname' => \arter\amos\translation\widgets\icons\WidgetIconTrContents::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\translation\widgets\icons\WidgetIconTranslation::className(),
                'default_order' => 20
            ],
            [
                'classname' => \arter\amos\translation\widgets\icons\WidgetIconTrPlatform::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\translation\widgets\icons\WidgetIconTranslation::className(),
                'default_order' => 30
            ],
            [
                'classname' => \arter\amos\translation\widgets\icons\WidgetIconTrLanguage::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\translation\widgets\icons\WidgetIconTranslation::className(),
                'default_order' => 40
            ],
            [
                'classname' => \arter\amos\translation\widgets\icons\WidgetIconTrOptimize::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\translation\widgets\icons\WidgetIconTranslation::className(),
                'default_order' => 50
            ],
            [
                'classname' => \arter\amos\translation\widgets\icons\WidgetIconTrScan::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\translation\widgets\icons\WidgetIconTranslation::className(),
                'default_order' => 60
            ],
        ];
    }
}
