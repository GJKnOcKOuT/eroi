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
 * @package    arter\amos\cwh
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\cwh\widgets\icons;

use arter\amos\core\icons\AmosIcons;
use arter\amos\core\widget\WidgetIcon;
use arter\amos\cwh\AmosCwh;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * TODO SOLO abbozzata per le regole e migration
 * Class WidgetIconCwhNodi
 *
 * @package arter\amos\cwh\widgets\icons
 */
class WidgetIconCwhRegolePubblicazione extends WidgetIcon
{

    /**
     * Init of the class, set of general configurations
     */
    public function init()
    {
        parent::init();

        $this->setLabel(AmosCwh::t('amoscwh', 'CWH regole di pubblicazione'));
        $this->setDescription(AmosCwh::t('amoscwh', 'CWH gestione regole di pubblicazione'));
        $this->setIcon('cwh');
        $this->setUrl(Yii::$app->urlManager->createUrl(['cwh/cwh-regole-pubblicazione']));
        $this->setCode('CWH_REGOLE_PUBBLICAZIONE');
        $this->setModuleName('cwh-regole-pubblicazione');
        $this->setNamespace(__CLASS__);

        $this->setClassSpan(
            ArrayHelper::merge(
                $this->getClassSpan(),
                [
                    'bk-backgroundIcon',
                    'color-darkGrey'
                ]
            )
        );
    }

}
