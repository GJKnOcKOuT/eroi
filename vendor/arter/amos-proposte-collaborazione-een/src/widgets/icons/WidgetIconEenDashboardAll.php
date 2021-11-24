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
 * @package    arter\amos\een\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\een\widgets\icons;

use arter\amos\core\icons\AmosIcons;
use arter\amos\core\widget\WidgetIcon;
use arter\amos\een\AmosEen;
use yii\helpers\ArrayHelper;
use arter\amos\core\widget\WidgetAbstract;


/**
 * Class WidgetIconEenDashboard
 *
 * @package arter\amos\een\widgets\icons
 */
class WidgetIconEenDashboardAll extends WidgetIcon
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->setLabel(AmosEen::tHtml('amoseen', 'Collaborazioni internazionali'));
        $this->setDescription(AmosEen::t('amoseen', 'Plugin per l\'accesso alle proposte di collaborazione EEN'));

        if (!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
            $this->setIconFramework(AmosIcons::IC);
            $this->setIcon('een-world');
            $paramsClassSpan = [];
        } else {
            $this->setIcon('proposte-een');
        }

        $this->setUrl(['/een/een-partnership-proposal/index']);
        $this->setCode('EEN');
        $this->setModuleName('een');
        $this->setNamespace(__CLASS__);

        $this->setClassSpan(
            ArrayHelper::merge(
                $this->getClassSpan(),
                $paramsClassSpan
            )
        );
    }

}
