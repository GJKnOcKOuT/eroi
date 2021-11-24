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


namespace arter\amos\een\widgets\graphics;

use arter\amos\core\widget\WidgetGraphic;

use arter\amos\een\AmosEen;

use arter\amos\een\models\EenPartnershipProposal;
use arter\amos\een\models\search\EenPartnershipProposalSearch;
use Yii;
use yii\helpers\ArrayHelper;
use arter\amos\notificationmanager\base\NotifyWidgetDoNothing;

class WidgetGraphicsLatestPartnershipProposalEen extends WidgetGraphic {

  /**
   * 
   */
  public function init() {
    parent::init();

    $this->setLabel(\Yii::t('amoseen', 'Proposte dal mondo'));
    $this->setDescription(Yii::t('amoseen', 'In collaborazione con Enterprise Europe Network'));
  }

  /**
   * rendering of the view ultime_discussioni
   *
   * @return string
   */
  public function getHtml() {
    $modelSearch = new EenPartnershipProposalSearch();
    $modelSearch->setNotifier(new NotifyWidgetDoNothing());
    $listaPartenership = $modelSearch->latestPartenershipProposalSearch($_GET, AmosEen::MAX_LAST_PARTNERSHIP_ON_DASHBOARD);

    $viewToRender = 'latest_partenership_profiles';


    return $this->render($viewToRender, [
        'listaPartnership' => $listaPartenership,
        'widget' => $this,
        'toRefreshSectionId' => 'widgetGraphicLatestThreads'
    ]);
  }

}
