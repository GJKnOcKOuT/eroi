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
 * @package    arter\amos\news
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m170217_152715_remove_news_allegati_permissions
 */
class m170217_152715_remove_news_allegati_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->setProcessInverted(true);
    }

    /**
     * Use this function to map permissions, roles and associations between permissions and roles. If you don't need to
     * to add or remove any permissions or roles you have to delete this method.
     */
    protected function setAuthorizations()
    {
        $this->authorizations = [
            [
                'name' => 'NEWSALLEGATI_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model NewsAllegati',
                'ruleName' => null,
                'parent' => ['CREATORE_NEWS', 'VALIDATORE_NEWS', 'FACILITATORE_NEWS']
            ],
            [
                'name' => 'NEWSALLEGATI_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model NewsAllegati',
                'ruleName' => null,
                'parent' => ['CREATORE_NEWS', 'VALIDATORE_NEWS', 'FACILITATORE_NEWS']
            ],
            [
                'name' => 'NEWSALLEGATI_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model NewsAllegati',
                'ruleName' => null,
                'parent' => ['CREATORE_NEWS', 'VALIDATORE_NEWS', 'FACILITATORE_NEWS']
            ],
            [
                'name' => 'NEWSALLEGATI_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model NewsAllegati',
                'ruleName' => null,
                'parent' => ['CREATORE_NEWS', 'VALIDATORE_NEWS', 'FACILITATORE_NEWS']
            ]
        ];
    }
}
