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
 * @package    arter\amos\chat
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\chat\widgets\graphics;

use arter\amos\chat\AmosChat;
use arter\amos\community\models\CommunityUserMm;
use arter\amos\core\module\BaseAmosModule;
use arter\amos\core\widget\WidgetGraphic;
use yii\helpers\Url;
use Yii;

/**
 * Class WidgetGraphicChatAssistance
 * @package arter\amos\chat\widgets\graphics
 */
class WidgetGraphicChatAssistance extends WidgetGraphic
{

    public $titleWidget = '';
    public $urlImage = '';
    public $assistanceUserId = '';
    public $buttonText = '';
    public $welcome_message = '';

    public $assistanceWidgetId = '';
    public $assistanceUserCommunityMan = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $isScope = false;
        $this->titleWidget = AmosChat::t('amoschat','#widget_graph_chat_assist_title');
        $this->buttonText = AmosChat::t('amos_chat', '#widget_graph_chat_assist_btn_text');

        $moduleCwh = \Yii::$app->getModule('cwh');
        if(isset($moduleCwh)){
            $scope = $moduleCwh->getCwhScope();
            if(!empty($scope) && isset($scope['community'])){

                $moduleChat = \Yii::$app->getModule('chat');
                if(!empty($moduleChat)){
                    if(!empty($moduleChat->assistenzaChatCommunity)){
                        foreach ($moduleChat->assistenzaChatCommunity as $communityId=>$conf){
                            $this->assistanceWidgetId = $communityId;
                            $explode = explode('-',$communityId);
                            $id = end($explode);
                            if($id == $scope['community']){
                                if(!empty($conf['titleWidget'])) {
                                    $this->titleWidget = $conf['titleWidget'];
                                }
                                if(!empty($conf['urlImage'])) {
                                    $this->urlImage = $conf['urlImage'];
                                }
                                if(!empty($conf['btnText'])) {
                                    $this->buttonText = $conf['btnText'];
                                }

                                if(!empty($conf['welcome_message'])) {
                                    $this->welcome_message = $conf['welcome_message'];
                                }

                                $userIdCM = null;
                                if(!empty($conf['assistance_community_manager']) && $conf['assistance_community_manager'] == true) {
                                    $userMm = CommunityUserMm::findOne(['community_id' => $id,  'role' => CommunityUserMm::ROLE_COMMUNITY_MANAGER]);
                                    if($userMm){
                                        $userIdCM = $userMm->user_id;
                                    }
                                }

                                if(!empty($conf['assistanceUserId'])){
                                    $this->assistanceUserId = $conf['assistanceUserId'];
                                }
                                if(!empty($userIdCM)){
                                    $this->assistanceUserId = $userIdCM;
                                }

                                $isScope = true;
                                break;
                            }
                        }
                    }
                }
            }
        }
        $this->setCode('CHAT_ASSISTANCE_GRAPHIC');
        $this->setLabel($this->titleWidget);
        $this->setDescription($this->titleWidget);
        return $isScope;
    }

    /**
     * @inheritdoc
     */
    public function getHtml()
    {
        if ((!empty($this->assistanceUserId)) && ($this->assistanceUserId != Yii::$app->user->id)) {
            $url = Url::to(['/messages', 'contactId' => $this->assistanceUserId]);
            return $this->render('chat-assistance', [
                'url' => $url,
                'widget' => $this,
            ]);
        }
    }

}
