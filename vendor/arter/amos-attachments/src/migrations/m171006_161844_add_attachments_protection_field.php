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
 * @package    arter\amos\attachments
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m150127_040544_add_attachments
 */
class m171006_161844_add_attachments_protection_field extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('attach_file_refs', 'protected', schema::TYPE_INTEGER." DEFAULT 0");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('attach_file_refs', 'protected');
    }
}
