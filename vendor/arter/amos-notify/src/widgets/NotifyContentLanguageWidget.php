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
 * @package    arter\amos\notificationmanager\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\notificationmanager\widgets;

use arter\amos\core\models\ModelsClassname;
use arter\amos\notificationmanager\models\NotificationContentLanguage;
use yii\base\InvalidConfigException;
use yii\base\Widget;

/**
 * Class NotifyContentLanguageWidget
 * @package arter\amos\notificationmanager\widgets
 */
class NotifyContentLanguageWidget extends Widget
{
    public $model;
    public $class = 'form-group col-xs-12';
    public $id = 'notify-content-language-widget';
    
    private $defaultLanguage;
    private $value;
    private $notificationContentLanguage = null;
    private $module;
    
    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();
        
        if (empty($this->model)) {
            throw new InvalidConfigException('The param $model is mandatory');
        }
        
        $modelclassname = ModelsClassname::find()
            ->andWhere(['classname' => get_class($this->model)])->one();
        
        if (empty($modelclassname)) {
            throw new InvalidConfigException('You have to configure the class ' . get_class($this->model) . ' in the table "models_classname"');
        }
        
        $module = \Yii::$app->getModule('notify');
        if ($module) {
            $this->module = $module;
        }
        
        $this->defaultLanguage = \Yii::$app->language;
        $language = $this->getNotifyContentLanguage();
        if (empty($language)) {
            $this->value = $this->defaultLanguage;
        } else {
            $this->value = $language;
        }
    }
    
    /**
     * @return string
     */
    public function run()
    {
        if ($this->module->enableNotificationContentLanguage) {
            return $this->render('notify_content_language', [
                'model' => $this->model,
                'value' => $this->value,
                'widget' => $this,
                'module' => $this->module
            ]);
        } else {
            return '';
        }
    }
    
    /**
     * @return null
     */
    public function getNotifyContentLanguage()
    {
        if (!$this->model->isNewRecord) {
            $classModel = get_class($this->model);
            $modelclassname = ModelsClassname::find()->andWhere(['classname' => $classModel])->one();
            if ($modelclassname) {
                $notificationContentLanguage = NotificationContentLanguage::find()
                    ->andWhere(['models_classname_id' => $modelclassname->id])
                    ->andWhere(['record_id' => $this->model->id])->one();
                $this->notificationContentLanguage = $notificationContentLanguage;
                if ($notificationContentLanguage) {
                    return $notificationContentLanguage->language;
                }
            }
        }
        return null;
    }
}
