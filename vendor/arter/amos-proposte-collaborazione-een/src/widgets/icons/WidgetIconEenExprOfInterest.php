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
use arter\amos\core\widget\WidgetAbstract;
use arter\amos\core\icons\AmosIcons;

use arter\amos\dashboard\models\AmosWidgets;

use arter\amos\een\AmosEen;
use arter\amos\een\models\EenPartnershipProposal;
use arter\amos\een\models\search\EenPartnershipProposalSearch;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconEen
 * @package arter\amos\news\widgets\icons
 */
class WidgetIconEenExprOfInterest extends WidgetIcon
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->setLabel(AmosEen::tHtml('amoseen', '#expr_of_interest_sended'));
        $this->setDescription(AmosEen::t('amoseen', '#expr_of_interest_sended'));
        $this->setIcon('proposte-een');
        $this->setUrl(['/een/een-expr-of-interest/index-own']);
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

        $search = new EenPartnershipProposalSearch();
        $this->setBulletCount(
            $this->makeBulletCounter(
                Yii::$app->getUser()->getId(),
                EenPartnershipProposal::className(),
                $search->buildQuery([], 'all')
            )
        );
    }

    /**
     * 
     */
//    public function makeBulletCounter($user_id = null)
//    {
//        $search = new EenPartnershipProposalSearch();
//        $notifier = Yii::$app->getModule('notify');
//        
//        $count = 0;
//        if ($notifier) {
//            $count = $notifier->countNotRead(
//                $user_id,
//                EenPartnershipProposal::className(),
//                $search->buildQuery([], 'all')
//            );
//        }
//
//        return $count;
//    }

    /**
     *  Aggiunge all'oggetto container tutti i widgets recuperati dal controller del modulo
     * 
     * @inheritdoc
     */
    public function getOptions()
    {
        return ArrayHelper::merge(
            parent::getOptions(),
            ['children' => $this->getWidgetsIcon()]
        );
    }

    /**
     * 
     * @return type
     */
    public function getWidgetsIcon()
    {
        return AmosWidgets::find()
            ->andWhere(['child_of' => self::className()])
            ->all();
    }

}
