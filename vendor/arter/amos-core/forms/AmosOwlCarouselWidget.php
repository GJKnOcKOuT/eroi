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
 * @package    arter\amos\core\forms
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\forms;

use arter\amos\core\exceptions\AmosException;
use arter\amos\core\module\BaseAmosModule;
use arter\amos\core\record\Record;
use Yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

/**
 * Class AmosOwlCarouselWidget
 * @package arter\amos\core\forms
 */
class AmosOwlCarouselWidget extends Widget
{
    /**
     * @var array $items
     */
    private $items = null;

    /**
     * @var string $widgetView The widget view.
     */
    protected $widgetView = "@vendor/arter/amos-core/forms/views/widgets/amos_owl_carousel_widget";

    /**
     * @var string $singleItemView The view for a single owl carousel item.
     */
    public $singleItemView = "";

    /**
     * @var string $owlCarouselId
     */
    public $owlCarouselId = 'owlCarouselWidget';

    /**
     * @var string $owlCarouselClass
     */
    public $owlCarouselClass = 'owl-carousel-class';

    /**
     * @var string $owlCarouselJSOptions
     */
    public $owlCarouselJSOptions = "{
        margin: 10,
        nav: true,
        loop: false,
        autoplay: false
    }";

    /**
     * @var array $additionalOptions
     */
    public $additionalOptions = [];

    /**
     * @var array $owlCarouselContent
     */
    private $owlCarouselContent = '';

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param array $items
     * @throws AmosException
     */
    public function setItems($items)
    {
        if (!is_array($items)) {
            throw new AmosException(BaseAmosModule::t('amoscore', '#widget_message_not_array', ['class' => basename(__CLASS__), 'param' => 'items']));
        }
        $this->items = $items;
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (is_null($this->items)) {
            throw new AmosException(BaseAmosModule::t('amoscore', '#widget_message_null_param', ['class' => basename(__CLASS__), 'param' => 'items']));
        }

        if (!is_array($this->items)) {
            throw new AmosException(BaseAmosModule::t('amoscore', '#widget_message_not_array', ['class' => basename(__CLASS__), 'param' => 'items']));
        }

        if (!is_string($this->singleItemView)) {
            throw new AmosException(BaseAmosModule::t('amoscore', '#widget_message_not_string', ['class' => basename(__CLASS__), 'param' => 'singleItemView']));
        }

        if (empty($this->singleItemView)) {
            throw new AmosException(BaseAmosModule::t('amoscore', '#widget_message_empty_string', ['class' => basename(__CLASS__), 'param' => 'singleItemView']));
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if (Yii::$app->getModule('layout')) {
            \arter\amos\layout\assets\OwlCarouselAsset::register($this->view);
        } else {
            throw new AmosException(BaseAmosModule::t('amoscore', '#amos_carousel_widget_missing_layout_module'));
        }

        if (!$this->composeOwlCarouselItems()) {
            return '';
        }

        return $this->render($this->widgetView, [
            'widget' => $this,
            'owlCarouselContent' => $this->owlCarouselContent,
            'containerOptions' => $this->composeOwlCarouselOptions(),
        ]);
    }

    /**
     * This method take the models present in the widget variable "items" and transform these models in carousel items.
     * @return bool
     */
    protected function composeOwlCarouselItems()
    {
        foreach ($this->items as $model) {
            /** @var Record $model */
            $this->owlCarouselContent .= $this->render($this->singleItemView, ['model' => $model, 'widget' => $this]);
        }
        return (!empty($this->owlCarouselContent));
    }

    /**
     * This method make the owl carousel options.
     * @return array
     */
    protected function composeOwlCarouselOptions()
    {
        $defaultOptions = [
            'id' => $this->owlCarouselId,
            'class' => $this->owlCarouselClass,
        ];
        $options = ArrayHelper::merge($this->additionalOptions, $defaultOptions);
        return $options;
    }
}
