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

class m160907_085708_insert_cwh_config extends Migration
{
    const TABLE = '{{%cwh_config}}';

    public function safeUp()
    {
        $classname = 'backend\modules\enti\models\Enti';
        $raw_sql = 'select 
concat(\'enti-\',`enti`.`id`) AS `id`,
1 AS `cwh_config_id`,
`enti`.`id` AS `record_id`,
\'backend\\\\modules\\\\enti\\\\models\\\\Enti\' AS `classname`,
`enti`.`created_at` AS `created_at`,
`enti`.`updated_at` AS `updated_at`,
`enti`.`deleted_at` AS `deleted_at`,
`enti`.`created_by` AS `created_by`,
`enti`.`updated_by` AS `updated_by`,
`enti`.`deleted_by` AS `deleted_by` 

from `enti`';
        $this->insert(self::TABLE, [
            'id' => '1',
            'classname' => $classname,
            'raw_sql' => $raw_sql,
            'tablename' => 'enti',
            'created_at' => null,
            'updated_at' => null,
            'deleted_at' => null,
            'created_by' => null,
            'updated_by' => null,
            'deleted_by' => null,
            'version' => null
        ]);
    }

    public function safeDown()
    {
        $this->delete(self::TABLE, ['id' => '1']);
    }
}