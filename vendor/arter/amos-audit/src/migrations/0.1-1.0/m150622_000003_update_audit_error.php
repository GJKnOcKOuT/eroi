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


use arter\amos\audit\models\AuditError;

class m150622_000003_update_audit_error extends \yii\db\Migration
{
    const TABLE = '{{%audit_error}}';

    public function up()
    {
        $this->addColumn(self::TABLE, 'emailed', 'int(11) NOT NULL AFTER trace');
        AuditError::updateAll(['emailed' => 1]); // set to 1 so we don't email all the old errors
    }

    public function down()
    {
        $this->dropColumn(self::TABLE, 'emailed');
    }
}
