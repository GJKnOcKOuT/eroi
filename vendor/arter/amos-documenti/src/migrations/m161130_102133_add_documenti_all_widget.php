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
 * @package    arter\amos\documenti\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationWidgets;
use arter\amos\dashboard\models\AmosWidgets;

/**
 * Class m161130_102133_add_documenti_all_widget
 */
class m161130_102133_add_documenti_all_widget extends AmosMigrationWidgets
{
    const MODULE_NAME = 'documenti';

    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => arter\amos\documenti\widgets\icons\WidgetIconDocumentiDashboard::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED
            ],
            [
                'classname' => \arter\amos\documenti\widgets\icons\WidgetIconAllDocumenti::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\documenti\widgets\icons\WidgetIconDocumentiDashboard::className()
            ],

            [
                'classname' => \arter\amos\documenti\widgets\icons\WidgetIconDocumenti::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\documenti\widgets\icons\WidgetIconDocumentiDashboard::className()
            ],
            [
                'classname' => arter\amos\documenti\widgets\icons\WidgetIconDocumentiCategorie::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\documenti\widgets\icons\WidgetIconDocumentiDashboard::className()
            ],
            [
                'classname' => arter\amos\documenti\widgets\icons\WidgetIconDocumentiCreatedBy::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\documenti\widgets\icons\WidgetIconDocumentiDashboard::className()
            ],
            [
                'classname' => arter\amos\documenti\widgets\icons\WidgetIconDocumentiDaValidare::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\documenti\widgets\icons\WidgetIconDocumentiDashboard::className()
            ],
            [
                'classname' => \arter\amos\documenti\widgets\graphics\WidgetGraphicsUltimiDocumenti::className(),
                'type' => AmosWidgets::TYPE_GRAPHIC,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\documenti\widgets\icons\WidgetIconDocumentiDashboard::className()
            ]
        ];
    }
}
