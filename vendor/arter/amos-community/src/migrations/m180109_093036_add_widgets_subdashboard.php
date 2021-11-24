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
 * @package    arter\amos\community\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\community\models\Community;
use yii\db\Migration;

/**
 * Class m171219_111336_add_community_field_hits
 */
class m180109_093036_add_widgets_subdashboard extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {

        $this->insert('amos_widgets', [
            'classname' => 'arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniDashboard',
            'type' => 'ICON',
            'module' => 'community',
            'status' => 1,
            'dashboard_visible' => 0,
            'sub_dashboard' => 1,
        ]);

        $this->insert('amos_widgets', [
            'classname' => 'arter\amos\documenti\widgets\icons\WidgetIconDocumentiDashboard',
            'type' => 'ICON',
            'module' => 'community',
            'status' => 1,
            'dashboard_visible' => 0,
            'sub_dashboard' => 1,
        ]);

        $this->insert('amos_widgets', [
            'classname' => 'arter\amos\news\widgets\icons\WidgetIconNewsDashboard',
            'type' => 'ICON',
            'module' => 'community',
            'status' => 1,
            'dashboard_visible' => 0,
            'sub_dashboard' => 1,
        ]);

        $this->insert('amos_widgets', [
            'classname' => 'arter\amos\showcaseprojects\widgets\icons\WidgetIconShowcaseProjectsDashboard',
            'type' => 'ICON',
            'module' => 'community',
            'status' => 1,
            'dashboard_visible' => 0,
            'sub_dashboard' => 1,
        ]);
    }
    
    /**
     * @inheritdoc
     */
    public function safeDown()
    {

        $this->delete('amos_widgets', [
            'classname' => 'arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniDashboard',
            'type' => 'ICON',
            'module' => 'community',
            'status' => 1,
            'dashboard_visible' => 0,
            'sub_dashboard' => 1,
        ]);

        $this->delete('amos_widgets', [
            'classname' => 'arter\amos\documenti\widgets\icons\WidgetIconDocumentiDashboard',
            'type' => 'ICON',
            'module' => 'community',
            'status' => 1,
            'dashboard_visible' => 0,
            'sub_dashboard' => 1,
        ]);

        $this->delete('amos_widgets', [
            'classname' => 'arter\amos\news\widgets\icons\WidgetIconNewsDashboard',
            'type' => 'ICON',
            'module' => 'community',
            'status' => 1,
            'dashboard_visible' => 0,
            'sub_dashboard' => 1,
        ]);

        $this->delete('amos_widgets', [
            'classname' => 'arter\amos\showcaseprojects\widgets\icons\WidgetIconShowcaseProjectsDashboard',
            'type' => 'ICON',
            'module' => 'community',
            'status' => 1,
            'dashboard_visible' => 0,
            'sub_dashboard' => 1,
        ]);
    }
}
