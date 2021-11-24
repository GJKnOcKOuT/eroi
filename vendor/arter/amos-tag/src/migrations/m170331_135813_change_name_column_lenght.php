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
 * @package    arter\amos\basic\template
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;

class m170331_135813_change_name_column_lenght extends Migration
{
    public function up()
    {
        $this->alterColumn('tag','nome','varchar(255)');

        return true;
    }

    public function down()
    {
        echo "m170331_135813_change_name_column_lenght cannot be reverted.\n";

        return false;
    }
    
}
