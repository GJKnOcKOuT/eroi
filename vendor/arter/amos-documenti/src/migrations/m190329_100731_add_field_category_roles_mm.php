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
 * Class m171206_092631_add_documenti_fields_1
 */
class m190329_100731_add_field_category_roles_mm extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->execute('
            INSERT INTO documenti_category_roles_mm (documenti_categorie_id, role)
            SELECT id, "BASIC_USER"
            FROM documenti_categorie
        ');

        $this->execute('
            INSERT INTO documenti_category_roles_mm (documenti_categorie_id, role)
            SELECT id, "ADMIN"
            FROM documenti_categorie
        ');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        return true;

    }
}
