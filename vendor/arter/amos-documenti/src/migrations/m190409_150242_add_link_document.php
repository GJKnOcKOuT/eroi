<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


use arter\amos\documenti\models\Documenti;
use yii\db\Migration;

/**
 * Class m190409_150242_add_link_document
 */
class m190409_150242_add_link_document extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            Documenti::tableName(), 
            'link_document', 
            $this
                ->char(255)
                ->null()
                ->defaultValue(null)
                ->comment('link to online document')
                ->after('version_parent_id')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(Documenti::tableName(), 'link_document');

        return false;
    }

}
