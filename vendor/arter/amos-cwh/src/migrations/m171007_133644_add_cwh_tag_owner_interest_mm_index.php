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
 * @package    arter\amos\cwh\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;

class m171007_133644_add_cwh_tag_owner_interest_mm_index extends Migration
{
    const TABLE = '{{%cwh_tag_owner_interest_mm}}';

    public function up()
    {
        try{
            $this->createIndex('fk_cwh_tag_owner_interest_mm_interest_classname_idx', self::TABLE, 'interest_classname');
            $this->createIndex('fk_cwh_tag_owner_interest_mm_tag_id_idx', self::TABLE, 'tag_id');
            $this->createIndex('fk_cwh_tag_owner_interest_mm_classname_idx', self::TABLE, 'classname');
            $this->createIndex('fk_cwh_tag_owner_interest_mm_record_id_idx', self::TABLE, 'record_id');
            $this->createIndex('fk_cwh_tag_owner_interest_mm_root_id_idx', self::TABLE, 'root_id');
        }catch(\yii\base\Exception $ex){
            echo $ex->getMessage();
        }
    }

    public function down()
    {
        try{
            $this->dropIndex('fk_cwh_tag_owner_interest_mm_interest_classname_idx', self::TABLE);
            $this->dropIndex('fk_cwh_tag_owner_interest_mm_tag_id_idx', self::TABLE);
            $this->dropIndex('fk_cwh_tag_owner_interest_mm_classname_idx', self::TABLE);
            $this->dropIndex('fk_cwh_tag_owner_interest_mm_record_id_idx', self::TABLE);
            $this->dropIndex('fk_cwh_tag_owner_interest_mm_root_id_idx', self::TABLE);
        }catch(\yii\base\Exception $ex){
            echo $ex->getMessage();
        }

    }
}
