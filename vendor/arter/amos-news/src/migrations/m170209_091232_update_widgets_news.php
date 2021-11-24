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
 * @package    arter\amos\news
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationWidgets;
use arter\amos\dashboard\models\AmosWidgets;

/**
 * Class m170209_091232_update_widgets_news
 */
class m170209_091232_update_widgets_news extends AmosMigrationWidgets
{
    const MODULE_NAME = 'news';

    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = array_merge(
            $this->initIconWidgetsConf(),
            $this->initGraphicWidgetsConf()
        );
    }

    /**
     * Init the icon widgets configurations
     * @return array
     */
    private function initIconWidgetsConf()
    {
        return [
            [
                'classname' => arter\amos\news\widgets\icons\WidgetIconNewsDashboard::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'default_order' => 1,
                'update' => true
            ],
            [
                'classname' => \arter\amos\news\widgets\icons\WidgetIconNews::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\news\widgets\icons\WidgetIconNewsDashboard::className(),
                'default_order' => 10,
                'update' => true
            ],
            [
                'classname' => arter\amos\news\widgets\icons\WidgetIconNewsCreatedBy::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\news\widgets\icons\WidgetIconNewsDashboard::className(),
                'default_order' => 30,
                'update' => true
            ],
            [
                'classname' => \arter\amos\news\widgets\icons\WidgetIconAllNews::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\news\widgets\icons\WidgetIconNewsDashboard::className(),
                'default_order' => 40,
                'update' => true
            ],
            [
                'classname' => arter\amos\news\widgets\icons\WidgetIconNewsDaValidare::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\news\widgets\icons\WidgetIconNewsDashboard::className(),
                'default_order' => 50,
                'update' => true
            ],
            [
                'classname' => arter\amos\news\widgets\icons\WidgetIconNewsCategorie::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\news\widgets\icons\WidgetIconNewsDashboard::className(),
                'default_order' => 60,
                'update' => true
            ]
        ];
    }

    /**
     * Init the graphic widgets configurations
     * @return array
     */
    private function initGraphicWidgetsConf()
    {
        return [
            [
                'classname' => \arter\amos\news\widgets\graphics\WidgetGraphicsUltimeNews::className(),
                'type' => AmosWidgets::TYPE_GRAPHIC,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\news\widgets\icons\WidgetIconNewsDashboard::className(),
                'default_order' => 1,
                'update' => true
            ]
        ];
    }
}
