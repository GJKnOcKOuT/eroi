<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\platform\common\console\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\libs\common\MigrationCommon;
use arter\amos\tag\models\Tag;
use yii\db\Migration;

/**
 * Class m181001_141113_add_rete_alta_tecnologia_tree
 */
class m200114_170113_add_community_id_partnershipprofiles extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('partnership_profiles', 'sfide_community_id', $this->integer()->after('id')->defaultValue(null)->comment('community'));
        $this->addForeignKey('fk_partnership_profiles_sfide_community_id1', 'partnership_profiles', 'sfide_community_id', 'community', 'id');
    }





        /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS = 0');
        $this->dropColumn('partnership_profiles', 'sfide_community_id');
        $this->execute('SET FOREIGN_KEY_CHECKS = 0');


    }
}
