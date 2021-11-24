<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace rossmann\cron\helpers;

/**
 * Class DbHelper
 * Contains common sql queries
 * @author  mult1mate
 * @since 05.01.2016
 */
class DbHelper
{
    /**
     * returns query for summary report
     * @return string
     */
    public static function getReportSql()
    {
        return "
        SELECT t.command, t.task_id,
        SUM(CASE WHEN tr.status = 'started' THEN 1 ELSE 0 END) AS started,
        SUM(CASE WHEN tr.status = 'completed' THEN 1 ELSE 0 END) AS completed,
        SUM(CASE WHEN tr.status = 'error' THEN 1 ELSE 0 END) AS error,
        round(AVG(tr.execution_time),2) AS time_avg,
        count(*) AS runs
        FROM task_runs AS tr
        LEFT JOIN tasks AS t ON t.task_id=tr.task_id
        WHERE tr.ts BETWEEN ? AND ? + INTERVAL 1 DAY
        GROUP BY command
        ORDER BY tr.task_id";
    }

    /**
     * returns query for TaskInterface table
     * @return string
     */
    public static function tableTasksSql()
    {
        return "CREATE TABLE `tasks` (
        `task_id` SMALLINT(6) NOT NULL AUTO_INCREMENT,
        `time` VARCHAR(64) NOT NULL,
        `command` VARCHAR(256) NOT NULL,
        `status` ENUM('active','inactive','deleted') DEFAULT 'active',
        `comment` VARCHAR(256) DEFAULT NULL,
        `ts` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `ts_updated` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
        PRIMARY KEY (`task_id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8";
    }

    /**
     * returns query for TaskRunInterface table
     * @return string
     */
    public static function tableTaskRunsSql()
    {
        return "CREATE TABLE `task_runs` (
        `task_run_id` INT(11) NOT NULL AUTO_INCREMENT,
        `task_id` SMALLINT(6) NOT NULL,
        `status` ENUM('started','completed','error') DEFAULT NULL,
        `execution_time` DECIMAL(6,2) NOT NULL DEFAULT '0.00',
        `ts` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `output` TEXT,
        PRIMARY KEY (`task_run_id`),
        KEY `task_id` (`task_id`), KEY `ts` (`ts`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
    }
}
