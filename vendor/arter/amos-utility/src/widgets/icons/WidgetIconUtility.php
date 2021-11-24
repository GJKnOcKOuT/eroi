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
 * @package    arter\amos\utility\widgets\icons
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\utility\widgets\icons;

use arter\amos\core\user\AmosUser;
use arter\amos\core\user\User;
use arter\amos\core\utilities\CoreCommonUtility;
use arter\amos\core\widget\WidgetIcon;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconUtility
 * @package arter\amos\utility\widgets\icons
 */
class WidgetIconUtility extends WidgetIcon
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->setLabel('Utility');
        $this->setDescription('Plugin Utility');
        $this->setIcon('linentita');
        $this->setUrl(['/utility']);
        $this->setCode('UTILITY_ADMIN');
        $this->setModuleName('utility');
        $this->setNamespace(__CLASS__);
        $this->setClassSpan(ArrayHelper::merge($this->getClassSpan(), [
            'bk-backgroundIcon',
            'color-primary'
        ]));
    }

    /**
     * @inheritdoc
     */
    public function isVisible()
    {
        $isVisible = parent::isVisible();
        if ($isVisible) {
            /** @var AmosUser $webUser */
            $webUser = \Yii::$app->user;
            /** @var User $loggedUser */
            $loggedUser = $webUser->identity;
            // Si vede solo su devel e produzione perché in nessuno dei due ambienti il cliente usa l'utente admin.
            // In qualche stage alcune volte succede quindi non c'è il widget in dashboard.
            // Per gli ambienti di test, stage o pre prod è necessario essere in azienda per vedere il widget.
            $isVisible = (
                $webUser->can('ADMIN') &&
                ($loggedUser->username == 'admin') &&
                (
                    YII_ENV_DEV ||
                    YII_ENV_PROD ||
                    CoreCommonUtility::platformSeenFromHeadquarter()
                )
            );
        }
        return $isVisible;
    }
}
