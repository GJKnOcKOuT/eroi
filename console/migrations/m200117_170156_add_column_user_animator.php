<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\platform\common\console\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationTableCreation;

/**
 * Description of m200117_170156_add_column_user_animator
 */
class m200117_170156_add_column_user_animator extends AmosMigrationTableCreation {

    public function up() {
        $this->addColumn('users_animation_mm', 'number_msg', $this->integer()->null()->defaultValue(0)->comment('Number message'));
    }

    public function down() {
        $this->dropColumn('users_animation_mm', 'number_msg');
    }

}
