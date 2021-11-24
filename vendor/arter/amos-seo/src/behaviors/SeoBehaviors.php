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
 * @package    arter\amos\seo\behaviors
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\seo\behaviors;

use arter\amos\seo\AmosSeo;
use arter\amos\seo\models\SeoData;

use Yii;
use yii\base\Event;
use yii\db\BaseActiveRecord;
use yii\behaviors\AttributeBehavior;

/**
 * Class SeoBehaviors
 * @package arter\amos\seo\behaviors
 */
class SeoBehaviors extends AttributeBehavior
{
    
    public $postParams;


    /**
     * @var \arter\amos\core\record\Record $sender ;
     */
    private $sender;
    
    /**
     * @return array
     */
    public function events()
    {
        return [
            BaseActiveRecord::EVENT_AFTER_UPDATE => 'eventSaveSeoData',
            BaseActiveRecord::EVENT_AFTER_INSERT => 'eventSaveSeoData',
            // non so se serve BaseActiveRecord::EVENT_BEFORE_VALIDATE => 'eventBeforeValidate',
            BaseActiveRecord::EVENT_BEFORE_DELETE => 'eventBeforeDelete'
        ];
    }
    
    /**
     * @param Event $event
     */
    public function eventSaveSeoData(Event $event)
    {
        $this->setSender($event->sender);
        
        if (isset($this->getSender()->deleted_at)) {
            return;
        }
        $seoData = SeoData::findOne([
                    'classname' => $this->getSender()->className(),
                    'content_id' => $this->getSender()->id
        ]);
        
        if (is_null($seoData)) {
            $seoData = new SeoData();
        }
        //pr($seoData->toArray(), 'eventSaveSeoData - $seoData');//exit;
        $pars = Yii::$app->request->post();
  
        $post = [];
        
        if (isset($_POST['SeoData'])) {
            $this->postParams = $_POST['SeoData'];
        }
        //pr($this->postParams, '$this->postParams');exit;
        $seoData->aggiornaSeoData($this->getSender(), $this->postParams);
        
    }
    
    
    /**
     * @param Event $event
     */
    public function eventBeforeDelete(Event $event)
    {
        $this->setSender($event->sender);
                
        if (isset($this->getSender()->deleted_at)) {
            return;
        }
        $seoData = SeoData::findOne([
                    'classname' => $this->getSender()->className(),
                    'content_id' => $this->getSender()->id
        ]);
        if (!is_null($seoData)) {
            $seoData->delete();
        }
    }
    
    
    /**
     * @param \yii\db\ActiveRecord $sender
     */
    private function setSender($sender)
    {
        $this->sender = $sender;
    }
    
    /**
     * @return \arter\amos\core\record\Record
     */
    private function getSender()
    {
        return $this->sender;
    }
    
}
