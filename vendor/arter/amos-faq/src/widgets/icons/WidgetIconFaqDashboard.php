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
 * @package    arter\amos\faq
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\faq\widgets\icons;

use arter\amos\core\icons\AmosIcons;
use arter\amos\core\widget\WidgetIcon;
use arter\amos\faq\AmosFaq;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconFaq
 *
 * @package arter\amos\faq\widgets\icons
 */
class WidgetIconFaqDashboard extends WidgetIcon
{
    /**
     * Init of the class, set of general configurations
     */
    public function init()
    {
        parent::init();
        $this->setLabel(AmosFaq::tHtml('amosfaq', 'FAQ'));
        $this->setDescription(AmosFaq::t('amosfaq', 'FAQ dashboard'));

        $this->setIcon('question-circle');
        //$this->setIconFramework();
        
        $this->setUrl(Yii::$app->urlManager->createUrl(['faq']));
        $this->setCode('FAQ_MODULE_000');
        $this->setModuleName('faq');
        $this->setNamespace(__CLASS__);
        $this->setClassSpan(ArrayHelper::merge($this->getClassSpan(), [
            'bk-backgroundIcon',
            'color-darkPrimary'
        ]));
    }


    /**
     * all widgets added to the container object retrieved from the module controller
     * @return array
     */
    public function getOptions()
    {
        $options = parent::getOptions();
        return ArrayHelper::merge($options, ["children" => $this->getWidgetsIcon()]);
    }

    /**
     * @todo TEMPORARY
     */
    public function getWidgetsIcon()
    {
        $widgets = [];

        $WidgetIconFaq = new WidgetIconFaq();

        if ($WidgetIconFaq->isVisible()) {
            $widgets[] = $WidgetIconFaq->getOptions();
        }


        return $widgets;
    }

}