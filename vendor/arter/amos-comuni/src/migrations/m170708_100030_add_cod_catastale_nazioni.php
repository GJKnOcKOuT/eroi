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
 * @package    arter\amos\comuni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
class m170708_100030_add_cod_catastale_nazioni extends \yii\db\Migration {

    public function safeUp() {
        $this->addColumn('istat_nazioni', 'codice_catastale', $this->string(255)->after('unione_europea'));
    }

    public function safeDown() {
        $this->dropColumn('istat_nazioni', 'codice_catastale');
    }

}
