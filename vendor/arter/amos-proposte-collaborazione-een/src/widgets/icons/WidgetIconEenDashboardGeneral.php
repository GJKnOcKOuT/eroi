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

use arter\amos\core\widget\WidgetIcon;
use arter\amos\een\AmosEen;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconEenDashboard
 *
 * @package arter\amos\een\widgets\icons
 */
class WidgetIconEenDashboardGeneral extends WidgetIcon
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->setLabel(AmosEen::tHtml('amoseen', 'Collaborazioni internazionali ADMIN'));
        $this->setDescription(AmosEen::t('amoseen', 'Plugin per l\'accesso alle proposte di collaborazione EEN'));
        $this->setIcon('proposte-een');
        $this->enableDashboardModal();
        $this->setUrl(['/een/een-partnership-proposal/index']);
        $this->setCode('EEN');
        $this->setModuleName('een');
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
    }

}
