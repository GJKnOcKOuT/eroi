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

namespace arter\amos\chat\widgets\icons;

use arter\amos\core\widget\WidgetIcon;
use arter\amos\core\widget\WidgetAbstract;
use arter\amos\core\icons\AmosIcons;

use arter\amos\chat\models\Message;
use arter\amos\chat\AmosChat;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconChatAssistance
 * @package arter\amos\chat\widgets\icons
 */
class WidgetIconChatAssistance extends WidgetIcon
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $paramsClassSpan = [
            'bk-backgroundIcon',
            'color-primary'
        ];

        $this->setLabel(AmosChat::tHtml('amoschat', 'Assistenza'));
        $this->setDescription(AmosChat::t('amoschat', 'Hai bisogno di assistenza?'));

        if (!empty(Yii::$app->params['dashboardEngine']) && Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
            $this->setIconFramework(AmosIcons::IC);
            $this->setIcon('assistenza');
            $paramsClassSpan = [];
        } else {
            $this->setIcon('comments-o');
        }

        $amosChat = AmosChat::getInstance();

        $this->setUrl(['/messages', 'contactId' => $amosChat->assistanceUserId]);
        $this->setCode('CHAT');
        $this->setModuleName('chat');
        $this->setNamespace(__CLASS__);

        $this->setClassSpan($paramsClassSpan);

        if ($this->disableBulletCounters == false) {
            $this->setBulletCount(
                $this->makeBulletCounter(
                    Yii::$app->getUser()->getId(),
                    Message::className(),
                    Message::find()
                        ->select('id')
                        ->andWhere([
                            'is_new' => true,
                            'receiver_id' => $user_id,
                            'is_deleted_by_receiver' => false
                        ])
                )
            );
        }
    }

    /**
     * Aggiunge all'oggetto container tutti i widgets recuperati dal controller del modulo
     * 
     * @return array
     */
    public function getOptions()
    {
        return ArrayHelper::merge(
                parent::getOptions(),
                ['children' => []]
        );
    }

    /**
     * 
     * @return boolean
     */
    public function isVisible()
    {
        if ($return = \Yii::$app->getUser()->can($this->getWidgetPermission())) {
            if (\Yii::$app->getModule('chat')->assistanceUserId != Yii::$app->user->id) {
                return true;
            }
        }

        return false;
    }

}
