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
 * @package    arter\amos\community
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\community\models\base;

use arter\amos\community\AmosCommunity;
use arter\amos\community\exceptions\CommunityException;
use arter\amos\community\utilities\EmailUtil;
use arter\amos\core\record\NetworkModel;
use arter\amos\core\user\User;
use arter\amos\core\utilities\Email;
use arter\amos\cwh\models\CwhAuthAssignment;
use arter\amos\cwh\utility\CwhUtil;
use arter\amos\dashboard\models\AmosWidgets;
use yii\helpers\ArrayHelper;

/**
 * Class Community
 *
 * This is the base-model class for table "community".
 *
 * @property integer $id
 * @property string $status
 * @property string $name
 * @property string $description
 * @property integer $hits
 * @property string $logo_id
 * @property string $cover_image_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property integer $community_type_id
 * @property integer $validated_once
 * @property integer $visible_on_edit
 * @property string $context
 * @property integer $parent_id
 *
 * @property \arter\amos\community\models\CommunityType $communityType
 * @property \arter\amos\core\user\User $createdByUser
 * @property \arter\amos\core\user\User $updatedByUser
 * @property \arter\amos\core\user\User[] $communityUsers
 * @property \arter\amos\community\models\CommunityUserMm[] $communityUserMms
 * @property AmosWidgets[] $amosWidgetsIcons
 * @property AmosWidgets[] $amosWidgetsIGraphics
 * @property \arter\amos\community\models\Community[] $subcommunities
 *
 * @package arter\amos\community\models\base
 */
abstract class Community extends NetworkModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'community';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        $requiredArray = AmosCommunity::getInstance()->communityRequiredFields;
        
        return [
            [$requiredArray, 'required'],
            [['description'], 'string' /*, 'max' => 500*/],
            [['context'], 'string'],
            [['logo_id', 'cover_image_id'], 'number'],
            [['hide_participants', 'force_workflow', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by', 'community_type_id', 'validated_once', 'visible_on_edit', 'parent_id', 'hits'], 'integer'],
            [['status', 'name'], 'string', 'max' => 255],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => AmosCommunity::t('amoscommunity', 'ID'),
            'status' => AmosCommunity::t('amoscommunity', 'Status'),
            'name' => AmosCommunity::t('amoscommunity', 'Name'),
            'description' => AmosCommunity::t('amoscommunity', 'Description'),
            'logo_id' => AmosCommunity::t('amoscommunity', 'Logo'),
            'cover_image_id' => AmosCommunity::t('amoscommunity', 'Cover image'),
            'created_at' => AmosCommunity::t('amoscommunity', 'Created at'),
            'updated_at' => AmosCommunity::t('amoscommunity', 'Updated at'),
            'deleted_at' => AmosCommunity::t('amoscommunity', 'Deleted at'),
            'created_by' => AmosCommunity::t('amoscommunity', 'Created by'),
            'updated_by' => AmosCommunity::t('amoscommunity', 'Updated by'),
            'deleted_by' => AmosCommunity::t('amoscommunity', 'Deleted by'),
            
            'communityType' => AmosCommunity::t('amoscommunity', 'Access type'),
            'community_type_id' => AmosCommunity::t('amoscommunity', 'Community type id'),
            
            'validated_once' => AmosCommunity::t('amoscommunity', 'Validated at least once'),
            'visible_on_edit' => AmosCommunity::t('amoscommunity', 'Visible while editing'),
            'context' => AmosCommunity::t('amoscommunity', 'Context'),
            'parent_id' => AmosCommunity::t('amoscommunity', 'Parent id'),
        ]);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommunityUserMms()
    {
        return $this->hasMany(\arter\amos\community\models\CommunityUserMm::className(), ['community_id' => 'id'])->inverseOf('community')
            ->from([CommunityUserMm::tableName() => CommunityUserMm::tableName()])
            ->innerJoin(User::tableName() . ' usr1', CommunityUserMm::tableName() . '.user_id = usr1.id and usr1.deleted_at IS NULL')
            ->innerJoin('user_profile', 'usr1.id = user_profile.user_id')
            ->andWhere(['user_profile.attivo' => 1]);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommunityType()
    {
        return $this->hasOne(\arter\amos\community\models\CommunityType::className(), ['id' => 'community_type_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommunityUsers()
    {
        return $this->hasMany(\arter\amos\core\user\User::className(), ['id' => 'user_id'])->via('communityUserMms');
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedByUser()
    {
        return $this->hasOne(\arter\amos\core\user\User::className(), ['id' => 'created_by']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedByUser()
    {
        return $this->hasOne(\arter\amos\core\user\User::className(), ['id' => 'updated_by']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcommunities()
    {
        return $this->hasMany(\arter\amos\community\models\Community::className(), ['parent_id' => 'id'])->andWhere(['context' => self::className()]);
    }
    
    /**
     * @return string the name of the community type
     */
    public function getCommunityTypeName()
    {
        return $this->communityType->name;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommunityAmosWidgetsMms()
    {
        return $this->hasMany(\arter\amos\community\models\CommunityAmosWidgetsMm::className(), ['community_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmosWidgetsIcons()
    {
        return $this->hasMany(AmosWidgets::className(), [ 'id' => 'amos_widgets_id'])->andWhere(['type' => 'ICON'])->via('communityAmosWidgetsMms');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmosWidgetsGraphics()
    {
        return $this->hasMany(AmosWidgets::className(), [ 'id' => 'amos_widgets_id'])->andWhere(['type' => 'GRAPHIC'])->via('communityAmosWidgetsMms');
    }





    /**
     * Before deleting the community, deletion of related records:
     * - subcommunities if present (and releted records)
     * - contents published for the community only (news, documents, ..)
     * - associations community-users
     * - CwhAuthAssignment permission for the community
     *
     * @return bool
     * @throws CommunityException
     */
    public function beforeDelete()
    {
        set_time_limit(1800);
        
        /** @var AmosCommunity $communityModule */
        $communityModule = \Yii::$app->getModule(AmosCommunity::getModuleName());
        $cwhConfigId = \arter\amos\community\models\Community::getCwhConfigId();
        
        if ($communityModule->deleteCommunityWithSubcommunities) {
            try {
                foreach ($this->subcommunities as $subcommunity) {
                    $subcommunity->delete();
                }
            } catch (\Exception $exception) {
                throw new CommunityException(AmosCommunity::t('amoscommunity', '#delete_community_delete_subcommunities_error'));
            }
        }
        
        if ($communityModule->deleteCommunityWithContents) {
            
            try {
                CwhUtil::deleteNetworkContents($cwhConfigId, $this->id);
            } catch (\Exception $exception) {
                throw new CommunityException(AmosCommunity::t('amoscommunity', '#delete_community_delete_contents_error'));
            }
        }
        
        try {
            foreach ($this->communityUserMms as $communityUserMm) {
                $this->deletedCommunityParticipantsMail($communityUserMm);
                $communityUserMm->delete();
            }
            
            $cwhPermissions = CwhAuthAssignment::find()->andWhere([
                'cwh_config_id' => $cwhConfigId,
                'cwh_network_id' => $this->id
            ])->all();
            
            /** @var CwhAuthAssignment $cwhPermission */
            foreach ($cwhPermissions as $cwhPermission) {
                $cwhPermission->delete();
            }
        } catch (\Exception $exception) {
            throw new CommunityException(AmosCommunity::t('amoscommunity', '#delete_community_delete_members_permission_error'));
        }
        
        return parent::beforeDelete();
    }
    
    /**
     * @param \arter\amos\community\models\CommunityUserMm $communityUserMm
     * @return bool
     */
    protected function deletedCommunityParticipantsMail($communityUserMm)
    {
        $emailUtil = new EmailUtil(EmailUtil::DELETED_COMMUNITY, $communityUserMm->role, $this, $communityUserMm->user->userProfile->nomeCognome, '', null, $communityUserMm->user_id);
        $subject = $emailUtil->getSubject();
        $text = $emailUtil->getText();
        if (isset(\Yii::$app->params['email-assistenza'])) {
            $from = \Yii::$app->params['email-assistenza'];
        } else {
            $from = 'assistenza@arter.it';
        }
        $tos = [$communityUserMm->user->email];
        return Email::sendMail($from, $tos, $subject, $text);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommunityUserField()
    {
        return $this->hasMany(\arter\amos\community\models\CommunityUserField::className(), [ 'community_id' => 'id']);
    }

}
