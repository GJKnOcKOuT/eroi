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
 * @package    arter\amos\documenti\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m190924_085218_add_permission_comment_validate
 */
class m190924_085218_add_permission_comment_validate extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'CommentValidate',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to validate a comment with cwh query',
                 'ruleName' => \arter\amos\comments\rules\CommunityUpdateContentRule::className(),
                'parent' => ['VALIDATED_BASIC_USER']
            ],
            [
                'name' => 'COMMENT_UPDATE',
                'update' => true,
                'newValues' => [
                    'addParents' => ['CommentValidate']
                ]
            ],
            [
                'name' => 'COMMENTREPLY_UPDATE',
                'update' => true,
                'newValues' => [
                    'addParents' => ['CommentValidate']
                ]
            ],
            [
                'name' => 'COMMENT_DELETE',
                'update' => true,
                'newValues' => [
                    'addParents' => ['CommentValidate']
                ]
            ],
            [
                'name' => 'COMMENTREPLY_DELETE',
                'update' => true,
                'newValues' => [
                    'addParents' => ['CommentValidate']
                ]
            ],

        ];
    }
}
