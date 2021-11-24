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

class WidgetIconEenExprOfInterestDashboard extends WidgetIcon
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->setLabel(AmosEen::t('amoseen', '#expression_of_interest_een_plural'));
        $this->setDescription(AmosEen::t('amoseen', '#expression_of_interest_een_plural'));
        $this->setIcon('proposte-een');
        $this->setIconFramework('dash');
        $this->setUrl(Yii::$app->urlManager->createUrl(['/een/een-expr-of-interest']));
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

    /**
     * Aggiunge all'oggetto container tutti i widgets recuperati dal controller del modulo
     * 
     * @return type
     */
    public function getOptions()
    {
        return ArrayHelper::merge(
            parent::getOptions(),
            ['children' => $this->getWidgetsIcon()]
        );
    }

    /**
     * Recupera i widget figli da far visualizzare nella dashboard secondaria
     * @return [arter\amos\core\widget\WidgetIcon] Array con i widget della dashboard
     */
    public function getWidgetsIcon()
    {
        $widgets = [];
        $widget = \arter\amos\dashboard\models\AmosWidgets::find()
            ->andWhere(['module' => 'partecipanti'])
            ->andWhere(['type' => 'ICON'])
            ->andWhere(['!=', 'child_of', null])
            ->all();

        foreach ($widget as $Widget) {
            $className = (strpos($Widget['classname'], '\\') === 0) ? $Widget['classname'] : '\\' . $Widget['classname'];
            $widgetChild = new $className;
            if ($widgetChild->isVisible()) {
                $widgets[] = $widgetChild->getOptions();
            }
        }

        return $widgets;
    }

}
