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
use yii\db\Schema;

class m161109_173720_init_default_cwh_view extends Migration
{


    public function safeUp()
    {
        $this->execute("
        CREATE OR REPLACE VIEW `cwh_nodi_view`  AS  
      
        select concat('user-',`user`.`id`) AS `id`,2 AS `cwh_config_id`,
        `user`.`id` AS `record_id`,'common\\\\models\\\\User' AS `classname`,
        `user`.`created_at` AS `created_at`,`user`.`updated_at` AS `updated_at`,`user`.`deleted_at` AS `deleted_at`,`user`.`created_by` AS `created_by`,`user`.`updated_by` AS `updated_by`,`user`.`deleted_by` AS `deleted_by` 
        from (`user` join `user_profile` on((`user`.`id` = `user_profile`.`user_id`))) 
        ;");

        return true;
    }

    public function safeDown()
    {

        return true;
    }
}
