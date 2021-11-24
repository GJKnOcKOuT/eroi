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
 * @package    arter\amos\faq
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use \arter\amos\core\migration\AmosMigration;
use arter\amos\dashboard\models\AmosWidgets;

class m160930_141452_dashboard_faq extends AmosMigration
{
    const MODULE_NAME = 'faq';
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
                'classname' => \arter\amos\faq\widgets\icons\WidgetIconFaqDashboard::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
            ],
            [
                'classname' => arter\amos\faq\widgets\icons\WidgetIconFaq::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\faq\widgets\icons\WidgetIconFaqDashboard::className()
            ],
            [
                'classname' => arter\amos\faq\widgets\icons\WidgetIconFaqCategorie::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\faq\widgets\icons\WidgetIconFaqDashboard::className()
            ],
            [
                'classname' => arter\amos\faq\widgets\icons\WidgetIconFaqStati::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\faq\widgets\icons\WidgetIconFaqDashboard::className()
            ],
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
            echo "Widget FAQ " . $newWidget['classname'] . " esistente. Skippo...\n";
        } else {
            $this->insert(AmosWidgets::tableName(), $newWidget);
            echo "Widget FAQ " . $newWidget['classname'] . " creato.\n";
        }
    }

    private function checkWidgetExist($classname)
    {

        return AmosWidgets::find()
            ->andWhere([
                'classname' => $classname
            ])->count();
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
