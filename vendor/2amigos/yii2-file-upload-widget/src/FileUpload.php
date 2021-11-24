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
 * @link https://github.com/2amigos/yii2-file-upload-widget
 * @copyright Copyright (c) 2013-2017 2amigOS! Consulting Group LLC
 * @license http://opensource.org/licenses/BSD-3-Clause
 */

namespace dosamigos\fileupload;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

/**
 * FileUpload
 *
 * Widget to render the jQuery File Upload Basic Uploader
 *
 * @author Antonio Ramirez <hola@2amigos.us>
 */
class FileUpload extends BaseUpload
{
    /**
     * @var bool whether to register the js files for the basic +
     */
    public $plus = false;

    /**
     * @var bool whether to render the default button
     */
    public $useDefaultButton = true;

    /**
     * @var string the upload view path to render the js upload template
     */
    public $uploadButtonTemplateView = 'uploadButton';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $url = Url::to($this->url);
        $this->options['data-url'] = $url;
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $input = $this->hasModel()
            ? Html::activeFileInput($this->model, $this->attribute, $this->options)
            : Html::fileInput($this->name, $this->value, $this->options);

        echo $this->useDefaultButton
            ? $this->render($this->uploadButtonTemplateView, ['input' => $input])
            : $input;

        $this->registerClientScript();
    }

    /**
     * Registers required script for the plugin to work as jQuery File Uploader
     */
    public function registerClientScript()
    {
        $view = $this->getView();

        if($this->plus) {
            FileUploadPlusAsset::register($view);
        } else {
            FileUploadAsset::register($view);
        }

        $options = Json::encode($this->clientOptions);
        $id = $this->options['id'];

        $js[] = ";jQuery('#$id').fileupload($options);";
        if (!empty($this->clientEvents)) {
            foreach ($this->clientEvents as $event => $handler) {
                $js[] = "jQuery('#$id').on('$event', $handler);";
            }
        }
        $view->registerJs(implode("\n", $js));
    }
}
