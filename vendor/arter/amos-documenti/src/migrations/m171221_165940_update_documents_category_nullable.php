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
 * @package    arter\amos\documenti\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\documenti\models\Documenti;
use yii\db\Migration;

/**
 * Class m171221_165940_update_documents_category_nullable
 */
class m171221_165940_update_documents_category_nullable extends Migration
{
    private $table = null;

    public function __construct()
    {
        $this->table = Documenti::tableName();
        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->alterColumn($this->table, 'documenti_categorie_id',  $this->integer(11)->null()->comment('Categoria'));

        return true;
    }
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->alterColumn($this->table, 'documenti_categorie_id',  $this->integer(11)->notNull()->comment('Categoria'));

        return true;
    }
}
