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
 * @package    arter\amos\tag
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\tag\models\Tag;
use yii\db\Migration;

/**
 * Class m180921_115026_alter_table_tag
 */
class m180921_115026_alter_table_tag extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {

        $this->addColumn(Tag::tableName(), 'child_allowed', $this->boolean()->notNull()->defaultValue(true));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn(Tag::tableName(), 'child_allowed');
    }
}
