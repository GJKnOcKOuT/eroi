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

use arter\amos\core\migration\AmosMigrationPermissions;
use arter\amos\organizzazioni\rules\ConfirmUserRequestRule;
use yii\rbac\Permission;

/**
 * Class m190211_163217_fix_organizzazioni_confirm_user_permission
 */
class m190211_163217_fix_organizzazioni_confirm_user_permission extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'CONFIRM_ORGANIZZAZIONI_OR_SEDI_USER_REQUEST',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per associare un utente a una sede di una organizzazione nel profilo utente',
                'ruleName' => ConfirmUserRequestRule::className(),
                'parent' => ['VALIDATED_BASIC_USER']
            ]
        ];
    }
}
