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
 * @link https://github.com/2amigos/yii2-gallery-widget
 * @copyright Copyright (c) 2013-2016 2amigOS! Consulting Group LLC
 * @license http://opensource.org/licenses/BSD-3-Clause
 */

namespace dosamigos\gallery;

use yii\helpers\Html;
use yii\helpers\Json;

/**
 * Carousel BlueImp Gallery Widget
 *
 * @author Alexander Kochetov <creocoder@gmail.com>
 */
class Carousel extends Gallery
{
    /**
     * @var bool whether to json encode items or not. If using Json to encode items, we will be able to render
     * different
     */
    public $json = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        Html::addCssClass($this->templateOptions, 'blueimp-gallery-carousel');
        $this->clientOptions['carousel'] = true;
    }

    /**
     * @inheritdoc
     */
    public function renderItems()
    {
        if ($this->json) {
            return null;
        }
        return parent::renderItems();
    }

    /**
     * @return string the carousel template
     */
    public function renderTemplate()
    {
        $template[] = '<div class="slides"></div>';
        $template[] = '<h3 class="title"></h3>';
        $template[] = '<a class="prev">‹</a>';
        $template[] = '<a class="next">›</a>';
        $template[] = '<a class="play-pause"></a>';
        $template[] = '<ol class="indicator"></ol>';

        return Html::tag('div', implode("\n", $template), $this->templateOptions);
    }

    /**
     * @inheritdoc
     */
    public function registerClientScript()
    {
        $view = $this->getView();
        GalleryAsset::register($view);
        DosamigosAsset::register($view);

        $id = $this->options['id'];
        $options = Json::encode($this->clientOptions);
        $items = $this->json ? Json::encode($this->items) : "$('#$id').find('a.gallery-item').hide()";
        $js = "blueimp_galleries = ( typeof blueimp_galleries != 'undefined' && blueimp_galleries instanceof Array ) ? blueimp_galleries : [];";
        $js .= "blueimp_galleries['$id']=blueimp.Gallery($items, $options);";
        $view->registerJs($js);
    }
}
