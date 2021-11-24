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
 * @package    arter\amos\community
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**
 * Class m170201_153634_remove_community_type_widget_and_permissions
 */
class m170201_153634_remove_community_type_widget_and_permissions extends \yii\db\Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $classNameWidget = 'arter\amos\community\widgets\icons\WidgetIconTipologiaCommunity';
        //remove from dashbords-widgets mm
        $this->delete('amos_user_dashboards_widget_mm', ['amos_widgets_classname' => $classNameWidget]);
        // remove from amos-widgets
        $this->delete('amos_widgets', ['classname' => $classNameWidget]);
        $this->delete('auth_item_child', ['child' => $classNameWidget]);
        $this->delete('auth_item', ['name' => $classNameWidget]);

        $this->delete('auth_item_child', "child LIKE 'TIPOLOGIACOMMUNITY_%'");
        $this->delete('auth_item', "name LIKE 'TIPOLOGIACOMMUNITY_%'");
        $this->delete('auth_assignment', "item_name LIKE 'TIPOLOGIACOMMUNITY_%'");

        $this->delete('auth_item_child', "child LIKE 'COMMUNITYTIPOLOGIACOMMUNITYMM_%'");
        $this->delete('auth_item', "name LIKE 'COMMUNITYTIPOLOGIACOMMUNITYMM_%'");
        $this->delete('auth_assignment', "item_name LIKE 'COMMUNITYTIPOLOGIACOMMUNITYMM_%'");

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "safe down not implemented for this migration";
        return true;
    }
}
