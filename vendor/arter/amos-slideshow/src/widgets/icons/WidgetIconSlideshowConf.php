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
 * @package    arter\amos\slideshow
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\slideshow\widgets\icons;

use arter\amos\core\widget\WidgetIcon;
use arter\amos\slideshow\AmosSlideshow;
use Yii;
use yii\helpers\ArrayHelper;

class WidgetIconSlideshowConf extends WidgetIcon
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->setLabel(AmosSlideshow::tHtml('amosslideshow', 'Slideshow'));
        $this->setDescription(AmosSlideshow::t('amosslideshow', 'Visualizza gli slideshow presenti'));
        $this->setIcon('image');
        if (!Yii::$app->user->isGuest) {
            $this->setUrl(\Yii::$app->urlManager->createUrl(['/slideshow/slideshow/index']));
        }

        $this->setCode('SLIDESHOW_LIST');
        $this->setModuleName('slideshow');
        $this->setNamespace(__CLASS__);

        $this->setClassSpan(
            ArrayHelper::merge(
                $this->getClassSpan(),
                [
                    'bk-backgroundIcon',
                    'color-darkPrimary'
                ]
            )
        );
    }

}
