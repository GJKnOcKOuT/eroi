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
 * Class m190408_103936_fix_profilo_sedi_country_id_empty_values
 */
class m190408_103936_fix_profilo_sedi_country_id_empty_values extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $italiaCountryId = 1;
        $this->update(ProfiloSedi::tableName(), ['country_id' => $italiaCountryId], ['or', ['country_id' => null], ['country_id' => 0]]);
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m190408_103936_fix_profilo_sedi_country_id_empty_values cannot be reverted.\n";
        return false;
    }
}
