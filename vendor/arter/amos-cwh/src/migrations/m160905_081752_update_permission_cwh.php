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
 * @package    arter\amos\cwh
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;

class m160905_081752_update_permission_cwh extends Migration
{
    const TABLE_PERMISSION = '{{%auth_item}}';

    public function up()
    {
        $this->insert(self::TABLE_PERMISSION, [
            'name' => 'CWHAUTHASSIGNMENTSEARCH_CREATE',
            'type' => '2',
            'description' => 'Permesso di CREATE sul model CwhAuthAssignment'
        ]);
        $this->insert(self::TABLE_PERMISSION, [
            'name' => 'CWHAUTHASSIGNMENTSEARCH_DELETE',
            'type' => '2',
            'description' => 'Permesso di DELETE sul model CwhAuthAssignment'
        ]);
        $this->insert(self::TABLE_PERMISSION, [
            'name' => 'CWHAUTHASSIGNMENTSEARCH_READ',
            'type' => '2',
            'description' => 'Permesso di READ sul model CwhAuthAssignment'
        ]);
        $this->insert(self::TABLE_PERMISSION, [
            'name' => 'CWHAUTHASSIGNMENTSEARCH_UPDATE',
            'type' => '2',
            'description' => 'Permesso di UPDATE sul model CwhAuthAssignment'
        ]);

        return true;
    }


}
