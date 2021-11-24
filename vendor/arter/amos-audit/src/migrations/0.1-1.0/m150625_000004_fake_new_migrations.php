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


use yii\db\Schema;

class m150625_000004_fake_new_migrations extends \yii\db\Migration
{
    public function up()
    {
        $now = time();
        $this->batchInsert(\Yii::$app->controller->migrationTable, ['version', 'apply_time'], [
            ['m150626_000001_create_audit_entry', $now],
            ['m150626_000002_create_audit_data', $now],
            ['m150626_000003_create_audit_error', $now],
            ['m150626_000004_create_audit_trail', $now],
            ['m150626_000005_create_audit_javascript', $now],
        ]);
    }

}
