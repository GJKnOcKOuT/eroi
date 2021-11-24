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
 * Class m191208_121218_add_profilo_field_contatto_referente_operativo
 */
class m191208_121218_add_profilo_field_contatto_referente_operativo extends Migration
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
        $this->addColumn($this->tableName, 'contatto_referente_operativo', $this->string(255)->defaultValue(null)->after('referente_operativo'));
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName, 'contatto_referente_operativo');
        return true;
    }
}
