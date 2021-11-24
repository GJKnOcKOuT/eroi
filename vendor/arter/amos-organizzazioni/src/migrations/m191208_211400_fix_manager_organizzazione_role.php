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
use arter\amos\organizzazioni\rules\UpdateLegalOperationalReferenceRule;

/**
 * Class m191208_211400_fix_manager_organizzazione_role
 */
class m191208_211400_fix_manager_organizzazione_role extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'BASIC_USER',
                'update' => true,
                'newValues' => [
                    'removeParents' => ['MANAGER_ORGANIZZAZIONE']
                ]
            ],
            [
                'name' => 'PROFILO_UPDATE',
                'update' => true,
                'newValues' => [
                    'removeParents' => ['MANAGER_ORGANIZZAZIONE']
                ]
            ],
            [
                'name' => 'PROFILOSEDI_UPDATE',
                'update' => true,
                'newValues' => [
                    'addParents' => [UpdateLegalOperationalReferenceRule::className()]
                ]
            ],
        ];
    }
}
