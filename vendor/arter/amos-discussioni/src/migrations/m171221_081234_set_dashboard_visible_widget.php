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
 * @package    arter\amos\discussioni\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;

/**
 * Class m171221_081234_set_dashboard_visible_widget
 */
class m171221_081234_set_dashboard_visible_widget extends Migration
{
    const TABLE = '{{%amos_widgets}}';

    public function safeUp()
    {
        $this->update(self::TABLE, ['dashboard_visible' => 1],
            ['classname' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniDashboard::className()]);
        return true;
    }

    public function safeDown()
    {
        $this->update(self::TABLE, ['dashboard_visible' => 0],
            ['classname' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniDashboard::className()]);
        return true;
    }
}
