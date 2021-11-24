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

use arter\amos\comments\rules\DeleteOwnCommentReplyRule;
use arter\amos\comments\rules\DeleteOwnCommentRule;
use arter\amos\comments\rules\DeleteOwnContentCommentsRule;
use arter\amos\comments\rules\UpdateOwnCommentReplyRule;
use arter\amos\comments\rules\UpdateOwnCommentRule;
use arter\amos\comments\rules\UpdateOwnContentCommentsRule;
use arter\amos\core\migration\AmosMigrationPermissions;
use yii\helpers\ArrayHelper;
use yii\rbac\Permission;

/**
 * Class m170524_102950_init_comments_permissions
 */
class m170524_102950_init_comments_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return ArrayHelper::merge(
            $this->setPluginRoles(),
            $this->setModelPermissions()
        );
    }
    
    private function setPluginRoles()
    {
        return [
            [
                'name' => 'COMMENTS_ADMINISTRATOR',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Administrator role for events plugin',
                'parent' => ['ADMIN']
            ],
            [
                'name' => 'COMMENTS_CONTRIBUTOR',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Comments validator role for events plugin'
            ]
        ];
    }
    
    private function setModelPermissions()
    {
        return [
            
            // Rules permissions
            [
                'name' => UpdateOwnCommentRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to modify own comment',
                'ruleName' => UpdateOwnCommentRule::className(),
                'parent' => ['COMMENTS_CONTRIBUTOR']
            ],
            [
                'name' => DeleteOwnCommentRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to delete own comment',
                'ruleName' => DeleteOwnCommentRule::className(),
                'parent' => ['COMMENTS_CONTRIBUTOR']
            ],
            [
                'name' => UpdateOwnCommentReplyRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to modify own comment reply',
                'ruleName' => UpdateOwnCommentRule::className(),
                'parent' => ['COMMENTS_CONTRIBUTOR']
            ],
            [
                'name' => DeleteOwnCommentReplyRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to delete own comment reply',
                'ruleName' => DeleteOwnCommentRule::className(),
                'parent' => ['COMMENTS_CONTRIBUTOR']
            ],
            [
                'name' => UpdateOwnContentCommentsRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to modify all the comments on own contents',
                'ruleName' => UpdateOwnContentCommentsRule::className(),
                'parent' => ['COMMENTS_CONTRIBUTOR']
            ],
            [
                'name' => DeleteOwnContentCommentsRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to delete all the comments on own contents',
                'ruleName' => DeleteOwnContentCommentsRule::className(),
                'parent' => ['COMMENTS_CONTRIBUTOR']
            ],
            
            // Permissions for model Comment
            [
                'name' => 'COMMENT_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Create permission for model Comment',
                'parent' => ['COMMENTS_ADMINISTRATOR', 'COMMENTS_CONTRIBUTOR']
            ],
            [
                'name' => 'COMMENT_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Read permission for model Comment',
                'parent' => ['COMMENTS_ADMINISTRATOR', 'COMMENTS_CONTRIBUTOR']
            ],
            [
                'name' => 'COMMENT_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Update permission for model Comment',
                'parent' => ['COMMENTS_ADMINISTRATOR', UpdateOwnCommentRule::className(), UpdateOwnContentCommentsRule::className()]
            ],
            [
                'name' => 'COMMENT_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Delete permission for model Comment',
                'parent' => ['COMMENTS_ADMINISTRATOR', DeleteOwnCommentRule::className(), DeleteOwnContentCommentsRule::className()]
            ],
            
            // Permissions for model CommentReply
            [
                'name' => 'COMMENTREPLY_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Create permission for model CommentReply',
                'parent' => ['COMMENTS_ADMINISTRATOR', 'COMMENTS_CONTRIBUTOR']
            ],
            [
                'name' => 'COMMENTREPLY_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Read permission for model CommentReply',
                'parent' => ['COMMENTS_ADMINISTRATOR', 'COMMENTS_CONTRIBUTOR']
            ],
            [
                'name' => 'COMMENTREPLY_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Update permission for model CommentReply',
                'parent' => ['COMMENTS_ADMINISTRATOR', UpdateOwnCommentReplyRule::className(), UpdateOwnContentCommentsRule::className()]
            ],
            [
                'name' => 'COMMENTREPLY_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Delete permission for model CommentReply',
                'parent' => ['COMMENTS_ADMINISTRATOR', DeleteOwnCommentReplyRule::className(), DeleteOwnContentCommentsRule::className()]
            ],
            
            // Permissions for model CommentContextAttribute
            [
                'name' => 'COMMENTCONTEXTATTRIBUTE_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Create permission for model CommentContextAttribute',
                'parent' => ['COMMENTS_ADMINISTRATOR']
            ],
            [
                'name' => 'COMMENTCONTEXTATTRIBUTE_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Read permission for model CommentContextAttribute',
                'parent' => ['COMMENTS_ADMINISTRATOR']
            ],
            [
                'name' => 'COMMENTCONTEXTATTRIBUTE_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Update permission for model CommentContextAttribute',
                'parent' => ['COMMENTS_ADMINISTRATOR']
            ],
            [
                'name' => 'COMMENTCONTEXTATTRIBUTE_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Delete permission for model CommentContextAttribute',
                'parent' => ['COMMENTS_ADMINISTRATOR']
            ]
        ];
    }
}
