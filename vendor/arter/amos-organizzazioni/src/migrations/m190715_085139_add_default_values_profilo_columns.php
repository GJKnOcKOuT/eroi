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

use arter\amos\organizzazioni\models\Profilo;
use yii\db\Migration;

/**
 * Class m190227_174839_alter_profilo_column_referente_operativo
 */
class m190715_085139_add_default_values_profilo_columns extends Migration
{
    private 
        $tableName = '';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->tableName = Profilo::tableName();
    }
    
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->alterColumn($this->tableName, 'indirizzo', $this->string(255)->defaultValue(null));
        $this->alterColumn($this->tableName, 'email', $this->string(255)->defaultValue(null));
        $this->alterColumn($this->tableName, 'responsabile', $this->string(255)->defaultValue(null));
        
        // Sarebbe in realtà un boolean!
        $this->alterColumn($this->tableName, 'la_sede_legale_e_la_stessa_del', $this->string(255)->defaultValue(null)); 
        
        $this->alterColumn($this->tableName, 'responsabile', $this->string(255)->defaultValue(null));
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        return true;
    }
}
