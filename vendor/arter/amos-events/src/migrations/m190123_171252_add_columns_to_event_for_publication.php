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
 * @package    arter\amos\events\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
use arter\amos\core\migration\AmosMigrationTableCreation;

/**
 * Description of m190123_171252_add_columns_to_event_for_publication publication
 *
 */
class m190123_171252_add_columns_to_event_for_publication extends AmosMigrationTableCreation {


    public function up() {
        $this->addColumn('event', 'primo_piano', "TINYINT(1) DEFAULT '0' COMMENT 'Primo piano'");
        $this->addColumn('event', 'in_evidenza', "TINYINT(1) DEFAULT '0' COMMENT 'In evidenza'");
    }

    public function down() {
        $this->dropColumn('event', 'primo_piano');
        $this->dropColumn('event', 'in_evidenza');
    }

}
