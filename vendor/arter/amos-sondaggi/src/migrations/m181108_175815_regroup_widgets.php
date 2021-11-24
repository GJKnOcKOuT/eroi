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
 * @package    arter\amos\admin\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\models\UserProfileArea;
use yii\db\Migration;

/**
 * Class m181012_162615_add_user_profile_area_field_1
 */
class m181108_175815_regroup_widgets extends Migration
{



    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->update('amos_widgets', ['dashboard_visible' => 0, 'child_of' => 'arter\amos\sondaggi\widgets\icons\WidgetIconSondaggiGeneral'], ['classname' => 'arter\amos\sondaggi\widgets\icons\WidgetIconPubblicaSondaggi']);
        $this->update('amos_widgets', ['dashboard_visible' => 0, 'child_of' => 'arter\amos\sondaggi\widgets\icons\WidgetIconSondaggiGeneral'], ['classname' => 'arter\amos\sondaggi\widgets\icons\WidgetIconSondaggi']);
        $this->update('amos_widgets', ['dashboard_visible' => 0, 'child_of' => 'arter\amos\sondaggi\widgets\icons\WidgetIconSondaggiGeneral'], ['classname' => 'arter\amos\sondaggi\widgets\icons\WidgetIconCompilaSondaggi']);



    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->update('amos_widgets', ['dashboard_visible' => 1, 'child_of' => 'arter\amos\sondaggi\widgets\icons\WidgetIconSondaggiGeneral'], ['classname' => 'arter\amos\sondaggi\widgets\icons\WidgetIconPubblicaSondaggi']);
        $this->update('amos_widgets', ['dashboard_visible' => 1,'child_of' => 'arter\amos\sondaggi\widgets\icons\WidgetIconSondaggiGeneral'], ['classname' => 'arter\amos\sondaggi\widgets\icons\WidgetIconSondaggi']);
        $this->update('amos_widgets', ['dashboard_visible' => 1,'child_of' => 'arter\amos\sondaggi\widgets\icons\WidgetIconSondaggiGeneral'], ['classname' => 'arter\amos\sondaggi\widgets\icons\WidgetIconCompilaSondaggi']);

    }
}
