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
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconBestPracticeAdminAll
 * @package arter\amos\best\practice\widgets\icons
 */
class WidgetIconSuperCraftOwnInterest extends WidgetIcon
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->setLabel(Module::tHtml('supercraft', 'Own Interest'));
        $this->setDescription(Module::t('supercraft', 'Own Interest'));
        $this->setIcon('linentita');
        $this->setUrl(['/bestpractice/best-practice/own-interest']);
        $this->setCode('SUPER_CRAFT_OWN_INTEREST');
        $this->setModuleName('supercraft');
        $this->setNamespace(__CLASS__);
        $this->setClassSpan(ArrayHelper::merge($this->getClassSpan(), [
            'bk-backgroundIcon',
            'color-primary'
        ]));
    }
}
