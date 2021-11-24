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
use yii\db\Schema;

class m171006_150910_add_cwh_auth_assignment_index extends Migration
{
    const TABLE = '{{%cwh_auth_assignment}}';

    public function up()
    {
        try{
            $this->alterColumn(self::TABLE,'user_id',Schema::TYPE_INTEGER );
            $this->createIndex('fk_cwh_auth_assignment_item_name_idx', self::TABLE, 'item_name');
            $this->createIndex('fk_cwh_auth_assignment_user_id_idx', self::TABLE, 'user_id');
            $this->createIndex('fk_cwh_auth_assignment_cwh_nodi_id_idx', self::TABLE, 'cwh_nodi_id');
        }catch(\yii\base\Exception $ex){
            echo $ex->getMessage();
        }
    }

    public function down()
    {
        try{
            $this->dropIndex('fk_cwh_auth_assignment_item_name_idx', self::TABLE);
            $this->dropIndex('fk_cwh_auth_assignment_user_id_idx', self::TABLE);
            $this->dropIndex('fk_cwh_auth_assignment_cwh_nodi_id_idx', self::TABLE);
            $this->alterColumn(self::TABLE,'user_id',Schema::TYPE_STRING. "(255)" );
        }catch(\yii\base\Exception $ex){
            echo $ex->getMessage();
        }

    }
}
