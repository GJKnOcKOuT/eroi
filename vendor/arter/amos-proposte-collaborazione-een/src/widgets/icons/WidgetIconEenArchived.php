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


namespace arter\amos\een\widgets\icons;

use arter\amos\core\widget\WidgetIcon;

use arter\amos\dashboard\models\AmosWidgets;

use arter\amos\een\AmosEen;
use arter\amos\een\models\EenPartnershipProposal;
use arter\amos\een\models\search\EenPartnershipProposalSearch;

use Yii;
use yii\helpers\ArrayHelper;

class WidgetIconEenArchived extends WidgetIcon
{

    /**
     * 
     */
    public function init()
    {
        parent::init();

        $this->setLabel(AmosEen::tHtml('amoseen', 'Archived'));
        $this->setDescription(AmosEen::t('amoseen', 'Archived Partnership Proposal'));

        $this->setIcon('proposte-een');
        $this->setCode('EEN');
        $this->setUrl(['/een/een-partnership-proposal/archived']);
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
//        $this->setBulletCount(
//            $this->makeBulletCounter(
//                Yii::$app->getUser()->getId(),
//                EenPartnershipProposal::className(),
//                $search->buildQuery([], 'archived')
//            )
//        );
    }

    /**
     * Aggiunge all'oggetto container tutti i widgets recuperati dal controller del modulo
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
