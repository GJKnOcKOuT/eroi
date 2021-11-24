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
 * @package    arter\amos\admin\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;
use arter\amos\admin\models\UserProfile;

class m170914_104613_change_sesso_enum extends Migration
{

    private $table = null;


    public function __construct()
    {
        $this->table = UserProfile::tableName();
        parent::__construct();
    }


    public function safeUp()
    {
        $this->alterColumn($this->table,'sesso', "ENUM('Maschio','Femmina','') DEFAULT NULL COMMENT 'Sesso'");
        return true;
    }

    public function safeDown()
    {

        $this->alterColumn($this->table,'sesso', "ENUM('Maschio','Femmina') DEFAULT NULL COMMENT 'Sesso'");
        return true;
    }


}
