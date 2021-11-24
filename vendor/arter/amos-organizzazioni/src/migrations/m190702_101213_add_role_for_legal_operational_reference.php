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
 * @package    care-for-workers\platform\common\console\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\organizzazioni\rules\UpdateLegalOperationalReferenceRule;


use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m190410_150048_add_care_for_workers_roles
 */
class m190702_101213_add_role_for_legal_operational_reference extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'MANAGER_ORGANIZZAZIONE',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Ruolo del responsabile di una organizzazione',
                'children' => [
                    'BASIC_USER',
                    'PROFILO_UPDATE',
                    'LETTORE_ORGANIZZAZIONI',
                    UpdateLegalOperationalReferenceRule::className(),
                ]
            ],
            [
                'name' => UpdateLegalOperationalReferenceRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per ruolo responsabile per le organizzazioni per cui è rappresentante legale o referente operativo',
                'ruleName' => UpdateLegalOperationalReferenceRule::className(),
                'children' => [
                    'PROFILO_UPDATE',
                ]
            ],
        ];
    }
}
