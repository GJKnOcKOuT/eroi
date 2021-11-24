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
 * @package    arter\amos\comments\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;

/**
 * Class m170717_124358_update_comments_role_descriptions
 */
class m170717_124358_update_comments_role_descriptions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'COMMENTS_ADMINISTRATOR',
                'update' => true,
                'newValues' => [
                    'description' => 'Administrator role for comments plugin',
                ],
                'oldValues' => [
                    'description' => 'Administrator role for events plugin',
                ]
            ],
            [
                'name' => 'COMMENTS_CONTRIBUTOR',
                'update' => true,
                'newValues' => [
                    'description' => 'Comments contributor role for comments plugin',
                ],
                'oldValues' => [
                    'description' => 'Comments validator role for events plugin',
                ]
            ]
        ];
    }
}