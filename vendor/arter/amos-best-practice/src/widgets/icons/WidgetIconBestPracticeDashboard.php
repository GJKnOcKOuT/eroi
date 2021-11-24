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
 * @package    arter\amos\best\practice\widgets\icons
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\best\practice\widgets\icons;

use arter\amos\best\practice\Module;
use arter\amos\core\widget\WidgetIcon;
use arter\amos\core\widget\WidgetAbstract;
use arter\amos\core\icons\AmosIcons;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconBestPracticeDashboard
 * @package arter\amos\best\practice\widgets\icons
 */
class WidgetIconBestPracticeDashboard extends WidgetIcon
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->setLabel(Module::tHtml('amosbestpractice', 'Best Practice'));
        $this->setDescription(Module::t('amosbestpractice', 'Modulo Best Practice'));

        if(!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
            $this->setIconFramework(AmosIcons::IC);
            $this->setIcon('bestpractice');
        }else {
            $this->setIcon('linentita');
        }

        $this->setUrl(['/bestpractice/best-practice/own-interest']);
        $this->setCode('BEST_PRACTICE_DASHBOARD');
        $this->setModuleName('bestpractice');
        $this->setNamespace(__CLASS__);

        $paramsClassSpan = ['bk-backgroundIcon',
            'color-primary'];
        if(!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
            $paramsClassSpan = [];
        }

        $this->setClassSpan(ArrayHelper::merge($this->getClassSpan(),
            $paramsClassSpan
        ));

    }
}
