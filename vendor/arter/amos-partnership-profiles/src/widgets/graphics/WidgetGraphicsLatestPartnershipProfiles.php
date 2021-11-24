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
 * @package    arter\amos\partnershipprofiles\widgets\graphics
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\partnershipprofiles\widgets\graphics;

use arter\amos\core\widget\WidgetGraphic;
use arter\amos\partnershipprofiles\models\search\PartnershipProfilesSearch;
use arter\amos\partnershipprofiles\Module;
use Yii;

/**
 * Class WidgetGraphicsLatestPartnershipProfiles
 * @package arter\amos\partnershipprofiles\widgets\graphics
 */
class WidgetGraphicsLatestPartnershipProfiles extends WidgetGraphic
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->setLabel(\Yii::t('amospartenershipprofiles', 'Latest partnership profiles'));
        $this->setDescription(Yii::t('amospartenershipprofile', 'Latest partnership profiles'));
    }

    /**
     * rendering of the view ultime_discussioni
     *
     * @return string
     */
    public function getHtml()
    {
        /** @var PartnershipProfilesSearch $modelSearch */
        $modelSearch = Module::instance()->createModel('PartnershipProfilesSearch');
        $listaPartenership = $modelSearch->latestPartenershipProfilesSearch($_GET, Module::MAX_LAST_PARTNERSHIP_ON_DASHBOARD);

        $viewToRender = 'latest_partenership_profiles';

        if (is_null(\Yii::$app->getModule('layout'))) {
            $viewToRender = 'latest_partenership_profiles_old';
        }

        return $this->render($viewToRender, [
            'listaPartnership' => $listaPartenership,
            'widget' => $this,
            'toRefreshSectionId' => 'widgetGraphicLatestThreads'
        ]);
    }
}
