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
 * @package    arter\amos\organizzazioni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;

class m180315_153030_alter_column_profile extends Migration
{

    const TABLE_PROFILO = '{{%profilo}}';

    public function safeUp()
    {

        $this->alterColumn('profilo', 'telefono', 'string');
        $this->alterColumn('profilo', 'fax', 'string');
        $this->alterColumn('profilo', 'sede_legale_telefono', 'string');
        $this->alterColumn('profilo', 'sede_legale_fax', 'string');



    }

    public function safeDown()
    {
        $this->alterColumn('profilo', 'telefono', 'integer');
        $this->alterColumn('profilo', 'fax', 'integer');
        $this->alterColumn('profilo', 'sede_legale_telefono', 'integer');
        $this->alterColumn('profilo', 'sede_legale_fax', 'integer');

    }


}
