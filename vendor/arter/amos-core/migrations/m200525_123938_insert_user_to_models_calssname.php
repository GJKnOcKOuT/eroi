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
 * @package    arter\amos\core\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;

/**
 * Class m191216_163838_fix_table_attributes_change_log
 */
class m200525_123938_insert_user_to_models_calssname extends Migration
{
    const TABLE = '{{%attributes_change_log}}';


    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert('models_classname', [
            'classname' => \arter\amos\core\user\User::className(),
            'module' => 'core',
            'label' => 'User',
        ]);
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS = 0;');
        $this->delete('models_classname', [
            'classname' => \arter\amos\core\user\User::className(),
            'module' => 'core',
            'label' => 'User',
        ]);
        $this->execute('SET FOREIGN_KEY_CHECKS = 1;');

        return true;
    }
}
