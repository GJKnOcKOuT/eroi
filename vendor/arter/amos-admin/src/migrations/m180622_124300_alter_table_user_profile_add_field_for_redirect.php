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
class m180622_124300_alter_table_user_profile_add_field_for_redirect extends Migration
{

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn(UserProfile::tableName(), 'first_access_login_effectuated', $this->integer()->null()->defaultValue(0)->after('widgets_selected')->comment("First login effectuated"));
        $this->addColumn(UserProfile::tableName(), 'first_access_redirect_url', $this->string()->null()->defaultValue(null)->after('widgets_selected')->comment("First access redirect url"));

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn(UserProfile::tableName(), 'first_access_login_effectuated');
        $this->dropColumn(UserProfile::tableName(), 'first_access_redirect_url');
    }

}