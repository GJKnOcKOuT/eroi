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
use arter\amos\organizzazioni\models\ProfiloEntiType;
use yii\db\Migration;

/**
 * Class m181011_131256_add_profilo_table_fields_istat_code_profilo_enti_type_id
 */
class m181011_131256_add_profilo_table_fields_istat_code_profilo_enti_type_id extends Migration
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
        $this->addColumn($this->tableName, 'istat_code', $this->string(10)->null()->defaultValue(null)->after('codice_fiscale')->comment('Istat Code'));
        $this->addColumn($this->tableName, 'profilo_enti_type_id', $this->integer()->notNull()->defaultValue(ProfiloEntiType::TYPE_OTHER_ENTITY)->after('parent_id')->comment('Profilo Enti Type Id'));
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName, 'istat_code');
        $this->dropColumn($this->tableName, 'profilo_enti_type_id');
        return true;
    }
}
