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
 * @package    arter\amos\documenti
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use arter\amos\documenti\rules\DeleteOwnDocumentiRule;
use arter\amos\documenti\rules\DeleteFacilitatorOwnDocumentiRule;
use arter\amos\documenti\rules\UpdateFacilitatorOwnDocumentiRule;
use arter\amos\documenti\rules\UpdateOwnDocumentiRule;
use arter\amos\documenti\models\Documenti;
use yii\rbac\Permission;

class m190225_154113_add_WidgetGraphicsDocumentsExplorer_all_permissions extends AmosMigrationPermissions
{
    /**
     * Use this function to map permissions, roles and associations between permissions and roles. If you don't need to
     * to add or remove any permissions or roles you have to delete this method.
     */
    protected function setAuthorizations()
    {
        $this->authorizations = [
            [
                'name' => arter\amos\documenti\widgets\graphics\WidgetGraphicsDocumentsExplorer::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per il widget WidgetGraphicsDocumentsExplorer',
                'ruleName' => null,
                'parent' => ['ADMIN', 'BASIC_USER']
            ],
        ];
    }
}
