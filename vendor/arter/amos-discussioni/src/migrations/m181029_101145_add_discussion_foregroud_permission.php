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


use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m170914_094129_add_validator_role
 */
class m181029_101145_add_discussion_foregroud_permission extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'DISCUSSION_FOREGROUD_PERMISSION',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'FOREGROUD FLAG PERMISSION',
                'parent' => ['ADMIN']
            ]
        ];
    }
}

