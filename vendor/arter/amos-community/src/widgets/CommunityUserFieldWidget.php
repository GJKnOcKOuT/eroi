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

/**
 */

namespace arter\amos\community\widgets;


use arter\amos\admin\models\UserProfile;
use arter\amos\community\utilities\CommunityUserFieldUtility;
use yii\base\InvalidConfigException;
use yii\base\Widget;

class CommunityUserFieldWidget extends Widget
{
    public $dynamicModel;
    public $form;
    public $community;
    public $isView = false;
    public $user_id;

    public function init()
    {
        parent::init();
        if(($this->isView == false && (empty($this->dynamicModel) || empty($this->form)))){
            throw new InvalidConfigException("The params 'dynamicModel' and  'form' are mandatory");
        }
        if($this->isView && (empty($this->user_id) )){
            throw new InvalidConfigException("The param 'user_id' is Mandatory");

        }
//        $this->loadDynamicModel();
    }

    public function run()
    {
        if($this->isView) {
            $model = UserProfile::find()->andWhere(['user_id' => $this->user_id])->one();
            return $this->render('community_user_fields_view', ['model' => $model]);
        }else {
            return $this->render('community_user_fields', ['dynamicModel' => $this->dynamicModel, 'form' => $this->form]);
        }

    }

//    public function loadDynamicModel(){
//        $this->dynamicModel =  CommunityUserFieldUtility::loadDynamicFields($this->community->id, $this->user_id);
//    }

}