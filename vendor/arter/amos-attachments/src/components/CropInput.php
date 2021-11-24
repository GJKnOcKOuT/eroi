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
 * @package    arter\amos\attachments
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\attachments\components;
 
use yii\widgets\InputWidget;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\Html; 
use yii\widgets\ActiveForm; 

class CropInput extends InputWidget
{
    /* @var ActiveForm */
    var $form = NULL;

    /** @var boolean */
    var $enableClientValidation;

    /** @var array */
    var $imageOptions;

    /** @var array */
    var $jcropOptions = [];

    /** @var integer */
    var $maxSize = 300;

    /** @var string */
    var $defaultPreviewImage = NULL;
 

    /** @var string */
    var $customHint = NULL;

    /** @var boolean */
    var $enableUploadFromGallery = true;

    /**
     *
     * @var boolean
     */
    var $isFrontend = false;

    /**
     * @param boolean  for enable hint message
     */
    var $enableHintMessage = true;

    /**
     * only call this method after a form closing and
     *    when user hasn't used in the widget call the parameter $form
     *    this adds to every form in the view the field validation.
     *
     * @param array $config
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    static function manualValidation($config = [])
    {

        if (!array_key_exists('model', $config) || !array_key_exists('attribute', $config)) {
            throw new InvalidParamException('Config array must have a model and attribute.');
        }

        $view = Yii::$app->getView();
        $field_id = Html::getInputId($config['model'], $config['attribute']);
        $view->registerJs('$("#' . $field_id . '").urlParser("launchValidation");');
    }

    /**
     * Renders the field.
     */
    public function run()
    {
        $fileModule = \Yii::$app->getModule('attachments');
        if($fileModule){
            if($fileModule->disableGallery){
                $this->enableUploadFromGallery = false;
            }
        }
        if ((property_exists($this->model, $this->attribute) || isset($this->model->{$this->attribute})) && $this->model->{$this->attribute}) {
            if (is_null($this->defaultPreviewImage)) {
                $this->defaultPreviewImage = $this->model->{$this->attribute}->url;
            }

            if (empty($this->jcropOptions)) {
                $this->jcropOptions = [
                    'aspectRatio' => 1,
                    'viewMode' => 3
                ];
            }
        }

        //Pick parent form
        if (is_null($this->form)) {
            $this->form = $this->field->form;
        }

        if (is_null($this->imageOptions)) {
            $this->imageOptions = [
                'alt' => 'Crop this image'
            ];
        }

        $this->imageOptions['id'] = Yii::$app->getSecurity()->generateRandomString(10);

        $inputField = Html::getInputId($this->model, $this->attribute, ['data-image_id' => $this->imageOptions['id']]);

        $default_jcropOptions = [
            'aspectRatio' => 1,
            'viewMode' => 2,
            'dashed' => FALSE,
            'zoomable' => FALSE,
            'rotatable' => true
        ];
        $default_options = [
            'accept' => "image/*",
        ];

        $this->jcropOptions = array_merge($default_jcropOptions, $this->jcropOptions);
        $this->options = array_merge($default_options, $this->options);

        return $this->render('crop-view', [
        'inputField' => $inputField,
        'crop' => $this,
        'aspectRatio' => $this->jcropOptions['aspectRatio'],
        'customHint'=>$this->customHint
        ]);
    }
}