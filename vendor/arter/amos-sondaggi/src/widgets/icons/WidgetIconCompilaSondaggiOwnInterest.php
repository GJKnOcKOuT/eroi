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
 * @package    arter\amos\sondaggi\widgets\icons
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\sondaggi\widgets\icons;

use arter\amos\core\widget\WidgetIcon;
use arter\amos\sondaggi\AmosSondaggi;
use yii\helpers\ArrayHelper;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\widget\WidgetAbstract;
use arter\amos\utility\models\BulletCounters;
use Yii;

/**
 * Class WidgetIconCompilaSondaggiOwnInterest
 * @package arter\amos\sondaggi\widgets\icons
 */
class WidgetIconCompilaSondaggiOwnInterest extends WidgetIcon
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->setLabel(AmosSondaggi::tHtml('amossondaggi', 'Sondaggi di mio interesse'));
        $this->setDescription(AmosSondaggi::t('amossondaggi', 'Permette di compilare e completare i sondaggi di tuo interesse'));

        if (!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
            $this->setIconFramework(AmosIcons::IC);
            $this->setIcon('sondaggi');
            $paramsClassSpan = [];
        } else {
            $this->setIcon('quote-right');
        }

        $this->setUrl(['/sondaggi/pubblicazione/own-interest']);
        $this->setCode('COMP_SONDAGGI_OWN_INTEREST');
        $this->setModuleName('sondaggi');
        $this->setNamespace(__CLASS__);

        $this->setClassSpan(
            ArrayHelper::merge(
                $this->getClassSpan(),
                [
                    'bk-backgroundIcon',
                    'color-primary'
                ]
            )
        );

         // Read and reset counter from bullet_counters table, bacthed calculated!
        if ($this->disableBulletCounters == false) {
            $this->setBulletCount(
                BulletCounters::getAmosWidgetIconCounter(
                    Yii::$app->getUser()->getId(), AmosSondaggi::getModuleName(), $this->getNamespace(),
                    $this->resetBulletCount(), WidgetIconCompilaSondaggiAll::className()
                )
            );
        }
    }

}
