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
use yii\rbac\Permission;

/**
 * Class m181026_083922_add_organizzazioni_sedi_associate_user_permission
 */
class m181026_083922_add_organizzazioni_sedi_associate_user_permission extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'ASSOCIATE_ORGANIZZAZIONI_SEDI_TO_USER',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per associare un utente a una sede di una organizzazione nel profilo utente',
                'parent' => ['USERPROFILE_UPDATE']
            ]
        ];
    }
}
