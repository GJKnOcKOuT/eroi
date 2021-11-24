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
 * @package    arter\amos\chat
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigration;
use yii\rbac\Permission;

class m161026_140626_add_amoschat_role extends AmosMigration
{
    /**
     * Use this instead of function up().
     * @see \Yii\db\Migration::safeUp() for more info.
     */
    public function safeUp()
    {
        // If you want to add permissions and roles. If you don't need this delete the code below.
        return $this->addAuthorizations();
    }

    /**
     * Use this instead of function down().
     * @see \Yii\db\Migration::safeDown() for more info.
     */
    public function safeDown()
    {
        // If you want to remove permissions and roles. If you don't need this delete the code below.
        return $this->removeAuthorizations();
    }

    /**
     * Use this function to map permissions, roles and associations between permissions and roles. If you don't need to
     * to add or remove any permissions or roles you have to delete this method.
     */
    protected function setAuthorizations()
    {
        $this->authorizations = [
            [
                'name' => 'AMMINISTRATORE_CHAT',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Ruolo del plugin chat',
                'ruleName' => null
            ],
            [
                'name' => \arter\amos\chat\widgets\icons\WidgetIconChat::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per vedere il widget di accesso ai messaggi',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_CHAT']
            ]
        ];
    }
}
