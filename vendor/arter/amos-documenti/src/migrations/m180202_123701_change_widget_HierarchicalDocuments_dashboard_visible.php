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

/**
 * Class m180202_123701_change_widget_HierarchicalDocuments_dashboard_visible
 */
class m180202_123701_change_widget_HierarchicalDocuments_dashboard_visible extends AmosMigrationWidgets
{
    const MODULE_NAME = 'documenti';

    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \arter\amos\documenti\widgets\graphics\WidgetGraphicsHierarchicalDocuments::className(),
                'dashboard_visible' => 0,
                'update' => true
            ]
        ];
    }
}
