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

use yii\db\Migration;
use arter\amos\admin\models\UserProfile;

/**
 * Class m180306_124300_alter_table_user_profile_add_first_access_wizard_steps_accessed
 */
class m180306_124300_alter_table_user_profile_add_first_access_wizard_steps_accessed extends Migration
{

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn(UserProfile::tableName(), 'first_access_wizard_steps_accessed', $this->text()->null()->defaultValue(null)->after('widgets_selected')->comment("Passi aperti in first access wizard"));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn(UserProfile::tableName(), 'first_access_wizard_steps_accessed');
    }

}