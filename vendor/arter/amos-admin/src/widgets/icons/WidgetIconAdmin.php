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

use arter\amos\core\widget\WidgetIcon;
use arter\amos\core\widget\WidgetAbstract;
use arter\amos\core\icons\AmosIcons;

use arter\amos\admin\AmosAdmin;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconAdmin
 * @package arter\amos\admin\widgets\icons
 */
class WidgetIconAdmin extends WidgetIcon
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

        $this->setLabel(AmosAdmin::tHtml('amosadmin', 'Users'));
        $this->setDescription(AmosAdmin::t('amosadmin', 'Users'));

        if (!empty(Yii::$app->params['dashboardEngine']) && Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
            $this->setIconFramework(AmosIcons::IC);
            $this->setIcon('user');
            $paramsClassSpan = [];
        } else {
            $this->setIcon('users');
        }

        $this->setUrl(['/admin']);
        $this->setCode('ADMIN_MODULE');
        $this->setModuleName(AmosAdmin::getModuleName());
        $this->setNamespace(__CLASS__);

        $this->setClassSpan(
            ArrayHelper::merge(
                $this->getClassSpan(),
                $paramsClassSpan
            )
        );
    }

    /**
     * @inheritdoc
     */
    public function getOptions()
    {
        return ArrayHelper::merge(
            parent::getOptions(),
            ['children' => $this->getWidgetsIcon()]
        );
    }

    /**
     * 
     * @return type
     */
    public function getWidgetsIcon()
    {
        $widgets = [];

        $MyProfile = new WidgetIconMyProfile();
        if ($MyProfile->isVisible()) {
            $widgets[] = $MyProfile->getOptions();
        }

        $UserProfile = new WidgetIconUserProfile();
        if ($UserProfile->isVisible()) {
            $widgets[] = $UserProfile->getOptions();
        }

        return $widgets;
    }

}
