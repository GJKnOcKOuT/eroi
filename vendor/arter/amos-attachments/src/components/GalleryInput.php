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

use arter\amos\attachments\FileModule;
use arter\amos\attachments\models\AttachGallery;
use arter\amos\attachments\models\AttachGalleryCategory;
use arter\amos\core\icons\AmosIcons;
use arter\amos\layout\assets\SpinnerWaitAsset;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\widgets\InputWidget;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


class GalleryInput extends Widget
{
    /* @var ActiveForm */
    public $form = NULL;

    /** @var string */
    public $attribute;

    /** @var string */
    public $gallery = 'general';

    /** @var array */
    public $options;


    /** @var $modelGallery AttachGallery */
    private $modelGallery;

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        $this->modelGallery = AttachGallery::findOne(['slug' => $this->gallery]);
        if (empty($this->attribute)) {
            throw new InvalidConfigException("The field attribute is required.");
        }
        if (empty($this->modelGallery)) {
            throw new InvalidConfigException("The gallery is not found, check if the slug of the gallery exists");
        }
        parent::init();
    }

    /**
     * Renders the field.
     */
    public function run()
    {

        $galleryId = $this->modelGallery->id;
        $attribute = $this->attribute;

        $this->registerAssets($galleryId, $attribute);

        return "<div class='loading' hidden></div>" .
            \arter\amos\core\helpers\Html::tag('div',
                \arter\amos\core\helpers\Html::a(
                    AmosIcons::show('collection-image') . FileModule::t('amosattachments', '#choose_image_from_gallery'), '#', [
                    'class' => 'open-modal-gallery',
                ]),
                ['class' => 'modal-gallery-container']
            )
            . \arter\amos\core\utilities\ModalUtility::amosModal([
                'id' => 'attach-gallery-' . $attribute,
                'modalBodyContent' => '',
                'modalClassSize' => 'modal-lg',
                'containerOptions' => [
                    'class' => 'modal-utility attachment-gallery-modal'
                ]
            ]);
    }


    /**
     * @param $galleryId
     * @param $attribute
     */
    public function registerAssets($galleryId, $attribute)
    {
        SpinnerWaitAsset::register($this->getView());
        $js = <<<JS
        $('.open-modal-gallery').click(function (event) {
            event.preventDefault();
            $('.loading').show();
           $('#attach-gallery-$attribute > .modal-dialog > .modal-content > .modal-body').load('/attachments/attach-gallery/load-modal?galleryId=$galleryId&attribute=$attribute', function () {
                $('#attach-gallery-$attribute').modal('show');
                $('.loading').hide();
            });
         });
JS;
        $this->getView()->registerJs($js);
    }
}