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
use arter\amos\een\AmosEen;
use Yii;
use yii\helpers\ArrayHelper;

class WidgetIconEenTagDashboard extends WidgetIcon
{
//    public function run()
//    {
//
//        $moduleCwh = \Yii::$app->getModule('cwh');
//        if (isset($moduleCwh) && !empty($moduleCwh->getCwhScope())) {
//            $scope = $moduleCwh->getCwhScope();
//            if (isset($scope['community'])) {
//                $community = \arter\amos\community\models\Community::findOne(['name'=>'Simpler']);
//                if (!empty($community)) {
//                    return parent::run();
//                }
//            }
//        }
//        return false;
//    }


    /**
     * @inheritdoc
     */
    public function init()
    {


        parent::init();

        $this->setLabel(AmosEen::t('amoseen', 'Converti TAG EEN in TAG S3 RER'));
        $this->setDescription(AmosEen::t('amoseen', 'Gestione tabella di conversione TAG EEN in TAG S3 RER'));
        $this->setIcon('proposte-een');
        $this->setIconFramework('dash');
        $this->setUrl(Yii::$app->urlManager->createUrl(['/een/een-tag-een/index']));
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
