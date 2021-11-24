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
 * @package    arter\amos\organizzazioni\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\organizzazioni\models\ProfiloSedi;
use yii\db\Migration;

/**
 * Class m181105_171143_fix_profilo_sedi_name_field
 */
class m181105_171143_fix_profilo_sedi_name_field extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->alterColumn(ProfiloSedi::tableName(), 'name', $this->string(255)->notNull());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->alterColumn(ProfiloSedi::tableName(), 'name', $this->string(100)->notNull());
    }
}
