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
class m181107_172115_remove_widgets extends Migration
{



    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->update('amos_widgets', ['dashboard_visible' => 0], ['classname' => 'arter\amos\documenti\widgets\graphics\WidgetGraphicsUltimiDocumenti', 'module' =>'documenti']);
        $this->update('amos_widgets', ['status' => 0], ['classname' => 'arter\amos\documenti\widgets\graphics\WidgetGraphicsHierarchicalDocuments']);


    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {

        $this->update('amos_widgets', ['dashboard_visible' => 1], ['classname' => 'arter\amos\documenti\widgets\graphics\WidgetGraphicsUltimiDocumenti']);
        $this->update('amos_widgets', ['status' => 1], ['classname' => 'arter\amos\documenti\widgets\graphics\WidgetGraphicsHierarchicalDocuments']);
    }
}
