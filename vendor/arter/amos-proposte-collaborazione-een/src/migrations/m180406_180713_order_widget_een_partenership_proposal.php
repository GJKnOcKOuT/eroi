<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


use yii\db\Migration;

/**
 * Handles the creation of table `een_partnership_proposal`.
 */
class m180406_180713_order_widget_een_partenership_proposal extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
       $this->update('amos_widgets', ['default_order' => 10], ['classname' => 'arter\amos\een\widgets\icons\WidgetIconEenAll', 'module' => 'een']);
       $this->update('amos_widgets', ['default_order' => 20], ['classname' => 'arter\amos\een\widgets\icons\WidgetIconEen', 'module' => 'een']);
       $this->update('amos_widgets', ['default_order' => 30], ['classname' => 'arter\amos\een\widgets\icons\WidgetIconEenArchived', 'module' => 'een']);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->update('amos_widgets', ['default_order' => 20], ['classname' => 'arter\amos\een\widgets\icons\WidgetIconEenAll', 'module' => 'een']);
        $this->update('amos_widgets', ['default_order' => 10], ['classname' => 'arter\amos\een\widgets\icons\WidgetIconEen', 'module' => 'een']);
        $this->update('amos_widgets', ['default_order' => 30], ['classname' => 'arter\amos\een\widgets\icons\WidgetIconEenArchived', 'module' => 'een']);
    }
}
