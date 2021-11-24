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


use yii\db\Migration;

class m160222_112000_install_task_manager extends Migration
{
    public function up()
    {
        $this->db->createCommand(\mult1mate\crontab\DbHelper::tableTasksSql())->execute();
        $this->db->createCommand(\mult1mate\crontab\DbHelper::tableTaskRunsSql())->execute();
    }

    public function down()
    {
        $this->dropTable('tasks');
        $this->dropTable('task_runs');
    }
}
