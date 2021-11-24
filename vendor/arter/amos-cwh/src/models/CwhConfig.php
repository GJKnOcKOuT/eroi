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

namespace arter\amos\cwh\models;

use arter\amos\cwh\AmosCwh;

/**
 * This is the model class for table "cwh_config".
 */
class CwhConfig extends \arter\amos\cwh\models\base\CwhConfig
{
    
    const RAW_SQL_EXAMPLE = 'select 
concat(\'tablename-\',`tablename`.`id`) AS `id`,
cwh_config_id AS `cwh_config_id`,
`tablename`.`id` AS `record_id`,
\'ModelClassName\' AS `classname`, 
-- use \'\\\\\' separator in classname to get sql code ok
1 AS `visibility`, 
-- 1 if no constraint on visibility of the network, otherwise put your condition 
-- eg. (CASE `tablename`.`visibility_attribute` WHEN 1 THEN 1 ELSE  0 END) AS `visibility`,
`tablename`.`created_at` AS `created_at`,
`tablename`.`updated_at` AS `updated_at`,
`tablename`.`deleted_at` AS `deleted_at`,
`tablename`.`created_by` AS `created_by`,
`tablename`.`updated_by` AS `updated_by`,
`tablename`.`deleted_by` AS `deleted_by` 

from `tablename`';

    public static function getConfig($className)
    {
        return self::findOne(['classname' => $className]);
    }

    public static function getConfigs()
    {
        return self::find()->all();
    }

    public function attributeHints()
    {
        return [
            'raw_sql' => AmosCwh::t('amoscwh', '#raw_sql_hint') . self::RAW_SQL_EXAMPLE,
            'visibility' => AmosCwh::t('amoscwh', '#visibility_hint')
        ];
    }

    public function getRawSql()
    {
        $table = \Yii::$app->db->schema->getTableSchema(self::tableName());
        //if exists and it's not set in model, calculate and set it before save
        if (isset($table->columns['visibility'])) {
            return 'select concat (\'' . $this->tablename . '-\',`' . $this->tablename . '`.`id`) AS `id`, ' .
                $this->id . ' AS `cwh_config_id`, ' .
                '`' . $this->tablename . '`.`id` AS `record_id`, ' .
                '\'' . addslashes($this->classname) . '\' AS `classname`, ' .
                $this->visibility . ' AS `visibility`, ' .
                '`' . $this->tablename . '`.`created_at` AS `created_at`, ' .
                '`' . $this->tablename . '`.`updated_at` AS `updated_at`, ' .
                '`' . $this->tablename . '`.`deleted_at` AS `deleted_at`, ' .
                '`' . $this->tablename . '`.`created_by` AS `created_by`, ' .
                '`' . $this->tablename . '`.`updated_by` AS `updated_by`, ' .
                '`' . $this->tablename . '`.`deleted_by` AS `deleted_by` ' .
                'from '.'`' . $this->tablename . '`';
        } else {
            return $this->raw_sql;
        }
    }

}
