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
 * @package    arter\amos\notificationmanager\widgets\icons
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\notificationmanager\widgets\icons;

use arter\amos\core\widget\WidgetIcon;
use arter\amos\notificationmanager\AmosNotify;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconNewsletterCreatedBy
 * @package arter\amos\notificationmanager\widgets\icons
 */
class WidgetIconNewsletterCreatedBy extends WidgetIcon
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->setLabel(AmosNotify::txt('#WidgetIconNewsletterCreatedBy_label'));
        $this->setDescription(AmosNotify::txt('#WidgetIconNewsletterCreatedBy_description'));
        $this->setIcon('printarea');
        $this->setUrl(['/notify/newsletter/created-by']);
        $this->setCode('NEWSLETTER');
        $this->setModuleName('notify');
        $this->setNamespace(__CLASS__);

        $this->setClassSpan(ArrayHelper::merge(
            $this->getClassSpan(), [
            'bk-backgroundIcon',
            'color-lightPrimary'
        ]));
    }
}
