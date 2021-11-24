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
use arter\amos\partnershipprofiles\Module;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconPartnershipProfilesDashboard
 * @package arter\amos\partnershipprofiles\widgets\icons
 */
class WidgetIconPartnershipProfilesDashboard extends WidgetIcon
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

        $this->setLabel(Module::tHtml('amospartnershipprofiles', '#widget_icon_partnership_profiles_dashboard_label'));
        $this->setDescription(Module::t('amospartnershipprofiles', '#widget_icon_partnership_profiles_dashboard_description'));

        if (!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
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

        $this->setUrl(['/partnershipprofiles']);
        $this->setCode('PARTNERSHIP_PROFILES_DASHBOARD');
        $this->setModuleName('partnershipprofiles');
        $this->setNamespace(__CLASS__);

        $this->setClassSpan(
            ArrayHelper::merge(
                $this->getClassSpan(),
                $paramsClassSpan
            )
        );

        $this->setBulletCount(
            $this->makeBulletCounter(
                Yii::$app->getUser()->getId()
            )
        );
    }

    /**
     * @param null $userId
     * @param null $className
     * @param null $externalQuery
     * @return string
     */
    public function makeBulletCounter($userId = null, $className = null, $externalQuery = null)
    {
        $widgetAll = new WidgetIconPartnershipProfilesAll();
        $widgetCreatedBy = new WidgetIconPartnershipProfilesCreatedBy();

        return $widgetAll->getBulletCount() + $widgetCreatedBy->getBulletCount();
    }
}
