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
 * @package    arter\amos\admin\widgets\icons
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\admin\widgets\icons;

use arter\amos\core\icons\AmosIcons;
use arter\amos\core\widget\WidgetAbstract;
use arter\amos\core\widget\WidgetIcon;

use arter\amos\admin\AmosAdmin;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconMyProfile
 * @package arter\amos\admin\widgets\icons
 */
class WidgetIconMyProfile extends WidgetIcon
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $paramsClassSpan = [
            'bk-backgroundIcon',
            'color-darkGrey'
        ];

        $this->setLabel(AmosAdmin::tHtml('amosadmin', 'Il mio profilo'));
        $this->setDescription(AmosAdmin::t('amosadmin', 'Consente all\'utente di modificare il proprio profilo'));

        if (!empty(Yii::$app->params['dashboardEngine']) && Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
            $this->setIconFramework(AmosIcons::IC);
            $this->setIcon('user');
            $paramsClassSpan = [];
        } else {
            $this->setIcon('users');
        }

        if (!Yii::$app->user->isGuest) {
            $this->setUrl(
                [
                    '/admin/user-profile/update',
                    'id' => Yii::$app->getUser()->id
                ]
            );
        }

        $this->setCode('USER_PROFILE');
        $this->setModuleName(AmosAdmin::getModuleName());
        $this->setNamespace(__CLASS__);

        $this->setClassSpan(
            ArrayHelper::merge(
                $this->getClassSpan(),
                $paramsClassSpan
            )
        );
    }

}
