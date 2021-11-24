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
 * @package    arter\amos\slideshow
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

class m161028_084814_add_slideshow_permissions extends AmosMigrationPermissions
{
    /**
     * Use this function to map permissions, roles and associations between permissions and roles. If you don't need to
     * to add or remove any permissions or roles you have to delete this method.
     */
    protected function setAuthorizations()
    {
        $this->authorizations = array_merge(
            $this->setPluginRoles(),
            $this->setModelPermissions(),
            $this->setWidgetsPermissions()
        );
    }

    private function setPluginRoles()
    {
        return [
            [
                'name' => 'AMMINISTRATORE_SLIDESHOW',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Ruolo amministratore per gli slideshow',
                'ruleName' => null,
                'parent' => ['ADMIN']
            ]
        ];
    }

    private function setModelPermissions()
    {
        return [
            // Model Slideshow
            [
                'name' => 'SLIDESHOW_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di creazione per il model degli slideshow',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_SLIDESHOW']
            ],
            [
                'name' => 'SLIDESHOW_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di lettura per il model degli slideshow',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_SLIDESHOW']
            ],
            [
                'name' => 'SLIDESHOW_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di modifica per il model degli slideshow',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_SLIDESHOW']
            ],
            [
                'name' => 'SLIDESHOW_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di cancellazione per il model degli slideshow',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_SLIDESHOW']
            ],

            // Model SlideshowRoute
            [
                'name' => 'SLIDESHOWROUTE_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di creazione per il model degli slideshow',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_SLIDESHOW']
            ],
            [
                'name' => 'SLIDESHOWROUTE_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di lettura per il model degli slideshow',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_SLIDESHOW']
            ],
            [
                'name' => 'SLIDESHOWROUTE_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di modifica per il model degli slideshow',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_SLIDESHOW']
            ],
            [
                'name' => 'SLIDESHOWROUTE_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di cancellazione per il model degli slideshow',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_SLIDESHOW']
            ],

            // Model SlideshowPages
            [
                'name' => 'MANAGE_SLIDESHOWPAGES',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di gestione delle pagine degli slideshow',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_SLIDESHOW']
            ],
            [
                'name' => 'SLIDESHOWPAGE_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di creazione per il model delle pagine degli slideshow',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_SLIDESHOW']
            ],
            [
                'name' => 'SLIDESHOWPAGE_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di lettura per il model delle pagine degli slideshow',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_SLIDESHOW']
            ],
            [
                'name' => 'SLIDESHOWPAGE_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di modifica per il model delle pagine degli slideshow',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_SLIDESHOW']
            ],
            [
                'name' => 'SLIDESHOWPAGE_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di cancellazione per il model delle pagine degli slideshow',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_SLIDESHOW']
            ]
        ];
    }

    private function setWidgetsPermissions()
    {
        return [
            [
                'name' => \arter\amos\slideshow\widgets\icons\WidgetIconSlideshow::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per la dashboard del plugin degli slideshow',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_SLIDESHOW']
            ],
            [
                'name' => \arter\amos\slideshow\widgets\icons\WidgetIconSlideshowConf::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per il widget della lista degli slideshow',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_SLIDESHOW']
            ]
        ];
    }
}
