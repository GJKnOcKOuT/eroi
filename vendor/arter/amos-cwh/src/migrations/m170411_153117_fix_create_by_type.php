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
 * @package    arter\amos\cwh
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
use yii\db\Migration;

/**
 * Class m170411_153117_fix_create_by_type
 */
class m170411_153117_fix_create_by_type extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('cwh_config_contents','created_by',$this->integer()->null());
        $this->alterColumn('cwh_config_contents','updated_by',$this->integer()->null());
        $this->alterColumn('cwh_config_contents','deleted_by',$this->integer()->null());
        return true;
    }

    public function safeDown()
    {
        $this->alterColumn('cwh_config_contents','created_by',$this->dateTime()->null());
        $this->alterColumn('cwh_config_contents','updated_by',$this->dateTime()->null());
        $this->alterColumn('cwh_config_contents','deleted_by',$this->dateTime()->null());

        return true;
    }
}
