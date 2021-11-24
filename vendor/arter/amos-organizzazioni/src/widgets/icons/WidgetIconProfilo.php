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
 * @package    arter\amos\organizzazioni\widgets\icons
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\organizzazioni\widgets\icons;

use arter\amos\core\icons\AmosIcons;
use arter\amos\core\widget\WidgetAbstract;
use arter\amos\core\widget\WidgetIcon;
use arter\amos\organizzazioni\Module;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconProfilo
 * @package arter\amos\organizzazioni\widgets\icons
 */
class WidgetIconProfilo extends WidgetIcon
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $paramsClassSpan = [
            'bk-backgroundIcon',
            'color-lightBase'
        ];

        $this->setLabel(Module::tHtml('amosorganizzazioni', '#widget_icon_profilo_label'));
        $this->setDescription(Module::t('amosorganizzazioni', '#widget_icon_profilo_description'));

        if (!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
            $this->setIconFramework(AmosIcons::IC);
            $this->setIcon('organizzazioni');
            $paramsClassSpan = [];
        } else {
            $this->setIcon('building-o');
        }

        if (!\Yii::$app->user->isGuest) {
            $this->setUrl(['/organizzazioni/profilo/index']);
        }

        $this->setCode('PROFILO');
        $this->setModuleName('organizzazioni');
        $this->setNamespace(__CLASS__);

        $this->setClassSpan(
            ArrayHelper::merge(
                $this->getClassSpan(),
                $paramsClassSpan
            )
        );
    }
}
