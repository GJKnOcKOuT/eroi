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
* Class m190320_171824_news_category_community_mm_permissions*/
class m190320_171824_news_category_community_mm_permissions extends AmosMigrationPermissions
{

    /**
    * @inheritdoc
    */
    protected function setRBACConfigurations()
    {
        $prefixStr = '';

        return [
                [
                    'name' =>  'NEWSCATEGORYCOMMUNITYMM_CREATE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di CREATE sul model NewsCategoryCommunityMm',
                    'ruleName' => null,
                    'parent' => ['AMMINISTRATORE_CATEGORIE_NEWS']
                ],
                [
                    'name' =>  'NEWSCATEGORYCOMMUNITYMM_READ',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di READ sul model NewsCategoryCommunityMm',
                    'ruleName' => null,
                    'parent' => ['AMMINISTRATORE_CATEGORIE_NEWS']
                    ],
                [
                    'name' =>  'NEWSCATEGORYCOMMUNITYMM_UPDATE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di UPDATE sul model NewsCategoryCommunityMm',
                    'ruleName' => null,
                    'parent' => ['AMMINISTRATORE_CATEGORIE_NEWS']
                ],
                [
                    'name' =>  'NEWSCATEGORYCOMMUNITYMM_DELETE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di DELETE sul model NewsCategoryCommunityMm',
                    'ruleName' => null,
                    'parent' => ['AMMINISTRATORE_CATEGORIE_NEWS']
                ],

            ];
    }
}
