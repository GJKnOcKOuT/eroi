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
 * @package    arter\amos\cwh
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigration;
use arter\amos\dashboard\models\AmosWidgets;

class m160928_152209_create_widget_cwh extends AmosMigration
{
    const MODULE_NAME = 'cwh';
    private $widgets;

    public function safeUp()
    {
        $this->initWidgetsConfs();

        foreach ($this->widgets as $singleWidget) {
            $this->insertNewWidget($singleWidget);
        }

        return true;
    }

    private function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \arter\amos\cwh\widgets\icons\WidgetIconCwhAuthAssignment::className(),
                'type' => \arter\amos\dashboard\models\AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED
            ],
            [
                'classname' => \arter\amos\cwh\widgets\icons\WidgetIconCwhRegolePubblicazione::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED
            ],
            [
                'classname' => \arter\amos\cwh\widgets\icons\WidgetIconCwhNodi::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED
            ],
            [
                'classname' => \arter\amos\cwh\widgets\icons\WidgetIconCwhConfig::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED
            ],
//            [
//                'classname' => \arter\amos\news\widgets\icons\WidgetIconNews::className(),
//                'type' => AmosWidgets::TYPE_ICON,
//                'module' => self::MODULE_NAME,
//                'status' => AmosWidgets::STATUS_ENABLED,
//                'child_of' => \arter\amos\news\widgets\icons\WidgetIconNewsDashboard::className()
//            ],
//            [
//                'classname' => arter\amos\news\widgets\icons\WidgetIconNewsCategorie::className(),
//                'type' => AmosWidgets::TYPE_ICON,
//                'module' => self::MODULE_NAME,
//                'status' => AmosWidgets::STATUS_ENABLED,
//                'child_of' => \arter\amos\news\widgets\icons\WidgetIconNewsDashboard::className()
//            ],
//            [
//                'classname' => arter\amos\news\widgets\icons\WidgetIconNewsCreatedBy::className(),
//                'type' => AmosWidgets::TYPE_ICON,
//                'module' => self::MODULE_NAME,
//                'status' => AmosWidgets::STATUS_ENABLED,
//                'child_of' => \arter\amos\news\widgets\icons\WidgetIconNewsDashboard::className()
//            ],
//            [
//                'classname' => arter\amos\news\widgets\icons\WidgetIconNewsDaValidare::className(),
//                'type' => AmosWidgets::TYPE_ICON,
//                'module' => self::MODULE_NAME,
//                'status' => AmosWidgets::STATUS_ENABLED,
//                'child_of' => \arter\amos\news\widgets\icons\WidgetIconNewsDashboard::className()
//            ],
//            [
//                'classname' => \arter\amos\news\widgets\graphics\WidgetGraphicsUltimeNews::className(),
//                'type' => AmosWidgets::TYPE_GRAPHIC,
//                'module' => self::MODULE_NAME,
//                'status' => AmosWidgets::STATUS_ENABLED,
//                'child_of' => \arter\amos\news\widgets\icons\WidgetIconNewsDashboard::className()
//            ]
        ];
    }

    /**
     * Metodo privato per l'inserimento della configurazione per un nuovo widget.
     *
     * @param array $newWidget Array chiave => valore contenente i dati da inserire nella tabella.
     */
    private function insertNewWidget($newWidget)
    {
        if ($this->checkWidgetExist($newWidget['classname'])) {
            echo "Widget news " . $newWidget['classname'] . " esistente. Skippo...\n";
        } else {
            $this->insert(AmosWidgets::tableName(), $newWidget);
            echo "Widget news " . $newWidget['classname'] . " creato.\n";
        }
    }

    private function checkWidgetExist($classname)
    {
        $sql = "SELECT COUNT(classname) FROM " . AmosWidgets::tableName() . " WHERE classname LIKE '" . addslashes(addslashes($classname)) . "'";
        $cmd = $this->db->createCommand();
        $cmd->setSql($sql);
        $oldWidgets = $cmd->queryScalar();
        return ($oldWidgets > 0);
    }

    public function safeDown()
    {
        $this->initWidgetsConfs();
        $this->execute("SET foreign_key_checks = 0;");
        foreach ($this->widgets as $singleWidget) {
            $where = " classname LIKE '" . addslashes(addslashes($singleWidget['classname'])) . "'";
            $this->delete(AmosWidgets::tableName(), $where);
        }
        $this->execute("SET foreign_key_checks = 1;");

        return true;
    }
}
