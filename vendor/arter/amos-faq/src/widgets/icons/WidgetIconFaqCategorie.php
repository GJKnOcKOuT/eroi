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
 * @package    arter\amos\faq\widgets\icons
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\faq\widgets\icons;

use arter\amos\core\widget\WidgetIcon;
use arter\amos\faq\AmosFaq;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconFaq
 * @package arter\amos\faq\widgets\icons
 */
class WidgetIconFaqCategorie extends WidgetIcon
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->setLabel(AmosFaq::tHtml('amosfaq', 'Gestione Categorie FAQ'));
        $this->setDescription(AmosFaq::t('amosfaq', 'Gestione delle categorie delle FAQ'));
        
        $this->setIcon('question-circle');
        
        $this->setUrl(['/faq/faq-categories/index']);
        $this->setCode('FAQ_MODULE_002');
        $this->setModuleName('faq');
        $this->setNamespace(__CLASS__);
        $this->setClassSpan(ArrayHelper::merge($this->getClassSpan(), [
            'bk-backgroundIcon',
            'color-darkPrimary'
        ]));
    }
}
