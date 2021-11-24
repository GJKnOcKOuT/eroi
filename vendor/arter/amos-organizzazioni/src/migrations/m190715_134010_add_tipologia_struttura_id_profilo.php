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

use arter\amos\organizzazioni\models\Profilo;
use yii\db\Migration;

/**
 * Class m181011_131256_add_profilo_table_fields_istat_code_profilo_enti_type_id
 */
class m190715_134010_add_tipologia_struttura_id_profilo extends Migration
{
    private $tableName;

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
        $this->addColumn(
            $this->tableName, 
            'tipologia_struttura_id', 
            $this->integer()->notNull()->defaultValue(null)->after('profilo_enti_type_id')->comment('Tipologia di Struttura Id')
        );
        
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName, 'tipologia_struttura_id');
        
        return true;
    }
}
