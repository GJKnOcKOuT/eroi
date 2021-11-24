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
 * @package    arter\amos\partnershipprofiles\widgets\icons
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\partnershipprofiles\widgets\icons;

use arter\amos\core\icons\AmosIcons;
use arter\amos\core\widget\WidgetAbstract;
use arter\amos\core\widget\WidgetIcon;
use arter\amos\partnershipprofiles\models\ExpressionsOfInterest;
use arter\amos\partnershipprofiles\models\search\ExpressionsOfInterestSearch;
use arter\amos\partnershipprofiles\Module;
use Yii;

/**
 * Class WidgetIconExpressionsOfInterestReceived
 * @package arter\amos\partnershipprofiles\widgets\icons
 */
class WidgetIconExpressionsOfInterestReceived extends WidgetIcon
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $paramsClassSpan = [
            'bk-backgroundIcon',
            'color-primary'
        ];

        $this->setLabel(Module::tHtml('amospartnershipprofiles', 'Received'));
        $this->setDescription(Module::t('amospartnershipprofiles', 'Show the expressions of interest received'));

        if (!empty(Yii::$app->params['dashboardEngine']) && Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
            $this->setIconFramework(AmosIcons::IC);
            $customIcon = Module::instance()->pluginCustomIcon;
            if (strlen($customIcon) > 0) {
                $this->setIcon($customIcon);
            } else {
                $this->setIcon('propostecollaborazione');
            }
            $paramsClassSpan = [];
        } else {
            $customIcon = Module::instance()->pluginCustomIcon;
            if (strlen($customIcon) > 0) {
                $this->setIcon($customIcon);
            } else {
                $this->setIcon('partnership-profiles');
            }
        }

        $this->setUrl(['/partnershipprofiles/expressions-of-interest/received']);
        $this->setCode('EXPRESSIONS_OF_INTEREST_RECEIVED');
        $this->setModuleName('partnershipprofiles');
        $this->setNamespace(__CLASS__);

        $loggedUser = \Yii::$app->user->identity;
        /** @var ExpressionsOfInterestSearch $search */
        $search = Module::instance()->createModel('ExpressionsOfInterestSearch');
        $query = $search->searchReceivedQuery([]);
        $query->andWhere([
                '>=',
                ExpressionsOfInterest::tableName() . '.created_at',
                $loggedUser->userProfile->ultimo_logout]
        );

        $this->setBulletCount(
            $this->makeBulletCounter(
                Yii::$app->getUser()->getId(),
                Module::instance()->model('ExpressionsOfInterest'),
                $search->searchReceivedQuery([])
            )
        );
    }
}
