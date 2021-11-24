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
 * @package    arter\amos\community\widgets\icons
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\community\widgets\icons;

use arter\amos\core\user\User;
use arter\amos\core\widget\WidgetIcon;
use arter\amos\core\widget\WidgetAbstract;
use arter\amos\core\icons\AmosIcons;

use arter\amos\attachments\models\File;

use arter\amos\community\AmosCommunity;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconAccademyDocument
 * @package arter\amos\community\widgets\icons
 */
class WidgetIconAccademyDocument extends WidgetIcon
{

    /**
     * @var bool $downloadEnabled
     */
    private $downloadEnabled = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $url = [''];
        if (isset(Yii::$app->params['isPoi']) && (Yii::$app->params['isPoi'] === true)) {
            $moduleCwh = Yii::$app->getModule('cwh');
            if (!is_null($moduleCwh)) {
                /** @var \arter\amos\cwh\AmosCwh $moduleCwh */
                $cwhScope = $moduleCwh->getCwhScope();
                if (!is_null($cwhScope) && (count($cwhScope) > 0)) {
                    if ($cwhScope['community'] == 2761) {
                        /** @var User $loggedUser */
                        $loggedUser = Yii::$app->user->identity;
                        $registrazioneLabLombardia = \openinnovation\landing\models\LandingLaboratorioLombardia::findOne(['email' => $loggedUser->email]);
                        if (!is_null($registrazioneLabLombardia) && !is_null($registrazioneLabLombardia->getProposal())) {
                            /** @var File $proposal */
                            $proposal = $registrazioneLabLombardia->getProposal();
                            $proposal->getUrl();
                            $this->downloadEnabled = true;
                            $url = $proposal->getWebUrl();
                        }
                    }
                }
            }
        }

        $this->setLabel(AmosCommunity::tHtml('amoscommunity', 'Proposta allegata'));
        $this->setDescription(AmosCommunity::t('amoscommunity', 'Visualizza la tua proposta'));
        $this->setIcon('file-text-o');
        $this->setUrl($url);
        $this->setTargetUrl('_blank');
        $this->setCode('COMMUNITY_ACCADEMY_DOCUMENT');
        $this->setModuleName('community');
        $this->setNamespace(__CLASS__);

        $paramsClassSpan = [
            'bk-backgroundIcon',
            'color-primary'
        ];

        if (!empty(Yii::$app->params['dashboardEngine']) && Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
            $paramsClassSpan = [];
        }

        $this->setClassSpan(
            ArrayHelper::merge(
                $this->getClassSpan(),
                $paramsClassSpan
            )
        );
    }

    /**
     * @inheritdoc
     */
    public function isVisible()
    {
        if (!$this->downloadEnabled) {
            return false;
        }

        return parent::isVisible();
    }

}
