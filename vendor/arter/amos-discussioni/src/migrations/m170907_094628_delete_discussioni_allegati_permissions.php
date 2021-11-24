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
 * @package    arter\amos\discussioni\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m170907_094628_delete_discussioni_allegati_permissions
 */
class m170907_094628_delete_discussioni_allegati_permissions extends AmosMigrationPermissions
{
    public function init()
    {
        parent::init();
        $this->setProcessInverted(true);
    }
    
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'DISCUSSIONIALLEGATI_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE allegati sul model DiscussioniAllegati',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_DISCUSSIONI', 'CREATORE_DISCUSSIONI', 'VALIDATORE_DISCUSSIONI', 'FACILITATORE_DISCUSSIONI']
            ],
            [
                'name' => 'DISCUSSIONIALLEGATI_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ allegati sul model DiscussioniAllegati',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_DISCUSSIONI', 'CREATORE_DISCUSSIONI', 'VALIDATORE_DISCUSSIONI', 'FACILITATORE_DISCUSSIONI']
            ],
            [
                'name' => 'DISCUSSIONIALLEGATI_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE allegati sul model DiscussioniAllegati',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_DISCUSSIONI', 'CREATORE_DISCUSSIONI', 'VALIDATORE_DISCUSSIONI', 'FACILITATORE_DISCUSSIONI']
            ],
            [
                'name' => 'DISCUSSIONIALLEGATI_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE allegati sul model DiscussioniAllegati',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_DISCUSSIONI', 'CREATORE_DISCUSSIONI', 'VALIDATORE_DISCUSSIONI', 'FACILITATORE_DISCUSSIONI']
            ],
        ];
    }
}
