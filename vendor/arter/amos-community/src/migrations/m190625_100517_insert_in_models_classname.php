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

/**
 * Class m170301_090817_alter_table_community_add_flags
 *
 * Create flag fields:
 * 'validated_once' : true if community has been validated at least one time
 * 'visible_on_edit': true if community must still be visible if is in editing status and validated_once is true
 */
class m190625_100517_insert_in_models_classname extends \yii\db\Migration
{
    const CLASSNAME = 'models_classname';


    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert(self::CLASSNAME, [
            'classname' => 'arter\amos\community\models\Community',
            'module' => 'community',
            'label' => 'Community'
        ]);
        return true;
    }
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete(self::CLASSNAME, [
            'classname' => 'arter\amos\community\models\Community',
            'module' => 'community',
            'label' => 'Community'
        ]);
        return true;
    }
}
