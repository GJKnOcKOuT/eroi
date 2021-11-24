<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\platform\common\console\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use backend\modules\aster_admin\models\UserProfile;
use arter\amos\admin\AmosAdmin;
use arter\amos\admin\models\UserProfileRole;
use yii\db\ActiveQuery;
use yii\db\Migration;

/**
 * Class m201216_114709_refactor_arter_user_profile_roles
 */
class m201216_114709_refactor_arter_user_profile_roles extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        /** @var AmosAdmin $adminModule */
        $adminModule = AmosAdmin::instance();
        
        /** @var UserProfile $userProfileModel */
        $userProfileModel = $adminModule->createModel('UserProfile');
        
        /** @var ActiveQuery $queryUserProfileRoles */
        $queryUserProfileRoles = UserProfileRole::find();
        $oldUserProfileRoles = $queryUserProfileRoles->all();
        
        $oldUserProfileRolesTranslated = [];
        foreach ($oldUserProfileRoles as $oldUserProfileRole) {
            /** @var UserProfileRole $oldUserProfileRole */
            $oldUserProfileRolesTranslated[$oldUserProfileRole->id] = AmosAdmin::t('amosadmin', $oldUserProfileRole->name);
        }
        
        /** @var ActiveQuery $queryUserProfiles */
        $queryUserProfiles = $userProfileModel::find();
        $userProfilesNotOtherRole = $queryUserProfiles->andWhere(['<>', 'user_profile_role_id', UserProfileRole::OTHER])->all();
        
        foreach ($userProfilesNotOtherRole as $userProfile) {
            /** @var UserProfile $userProfile */
            $userProfile->user_profile_role_other = $oldUserProfileRolesTranslated[$userProfile->user_profile_role_id];
            $userProfile->user_profile_role_id = UserProfileRole::OTHER;
            $userProfile->save(false);
        }
        
        $this->update(UserProfileRole::tableName(), ['enabled' => 0], ['<>', 'id', UserProfileRole::OTHER]);
        
        $this->batchInsert(UserProfileRole::tableName(), [
            'name',
            'enabled',
            'order',
            'type_cat'
        ], [
            ["Addetto ricerca e sviluppo", 1, 10, UserProfileRole::TYPE_CAT_GENERIC],
            ["Consulente", 1, 20, UserProfileRole::TYPE_CAT_GENERIC],
            ["Dipendente", 1, 30, UserProfileRole::TYPE_CAT_GENERIC],
            ["Manager / Dirigente", 1, 40, UserProfileRole::TYPE_CAT_GENERIC],
            ["Docente univ. / Ricercatore", 1, 50, UserProfileRole::TYPE_CAT_GENERIC],
            ["Imprenditore", 1, 60, UserProfileRole::TYPE_CAT_GENERIC],
            ["Libero professionista", 1, 70, UserProfileRole::TYPE_CAT_GENERIC],
            ["Startupper", 1, 80, UserProfileRole::TYPE_CAT_GENERIC]
        ]);
        
        return true;
    }
    
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m201216_114709_refactor_arter_user_profile_roles cannot be reverted.\n";
        return false;
    }
}
