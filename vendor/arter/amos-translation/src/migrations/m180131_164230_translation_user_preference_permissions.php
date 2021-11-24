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
 * @package    arter\amos\translation\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m180131_164230_translation_user_preference_permissions
 */
class m180131_164230_translation_user_preference_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'TRANSLATIONUSERPREFERENCE_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model TranslationUserPreference',
                'ruleName' => null,
                'parent' => ['ADMIN']
            ],
            [
                'name' => 'TRANSLATIONUSERPREFERENCE_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model TranslationUserPreference',
                'ruleName' => null,
                'parent' => ['ADMIN']
            ],
            [
                'name' => 'TRANSLATIONUSERPREFERENCE_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model TranslationUserPreference',
                'ruleName' => null,
                'parent' => ['ADMIN']
            ],
            [
                'name' => 'TRANSLATIONUSERPREFERENCE_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model TranslationUserPreference',
                'ruleName' => null,
                'parent' => ['ADMIN']
            ],
        ];
    }
}
