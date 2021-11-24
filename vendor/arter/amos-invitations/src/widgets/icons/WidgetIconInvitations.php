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
 * @package    arter\amos\invitations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\invitations\widgets\icons;

use arter\amos\core\widget\WidgetIcon;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconInvitations
 * @package arter\amos\invitations\widgets\icons
 */
class WidgetIconInvitations extends WidgetIcon
{

    public function init()
    {
        parent::init();

        $this->setLabel(\Yii::t('amosinvitations', 'Invitations'));
        $this->setDescription(Yii::t('amosinvitations', 'To manage invitations to the platform'));

        $this->setIcon('notifications');
        $this->setIconFramework('am');
        $this->setUrl(Yii::$app->urlManager->createUrl(['/invitations/invitation/index']));
        $this->setModuleName('amos_invitations');
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
