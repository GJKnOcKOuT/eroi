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
 * @package    arter\amos\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\emailmanager\models\EmailSpool;
use yii\db\Migration;

class m170220_161458_add_viewparams extends Migration
{
    public function safeUp()
    {
        $this->addColumn(EmailSpool::tableName(), 'viewParams', 'LONGBLOB DEFAULT NULL AFTER files');

        return true;
    }

    public function safeDown()
    {
        $this->dropColumn(EmailSpool::tableName(), 'viewParams');

        return true;
    }
}
