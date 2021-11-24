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
use arter\amos\admin\models\UserProfile;
use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconInactiveUserProfiles
 * @package arter\amos\admin\widgets\icons
 */
class WidgetIconInactiveUserProfiles extends WidgetIcon
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

        $this->setLabel(AmosAdmin::tHtml('amosadmin', 'Inactive users'));
        $this->setDescription(AmosAdmin::t('amosadmin', 'List of inactive platform users'));

        if (!empty(Yii::$app->params['dashboardEngine']) && Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
            $this->setIconFramework(AmosIcons::IC);
            $this->setIcon('user');
            $paramsClassSpan = [];
        } else {
            $this->setIcon('users');
        }

        $this->setUrl(['/admin/user-profile/inactive-users']);
        $this->setCode('INACTIVE_USERS');
        $this->setModuleName(AmosAdmin::getModuleName());
        $this->setNamespace(__CLASS__);

        $this->setClassSpan(
            ArrayHelper::merge(
                $this->getClassSpan(), $paramsClassSpan
            )
        );

        $query = new Query();
        $query
            ->select([UserProfile::tableName().'.id', UserProfile::tableName().'.attivo', UserProfile::tableName().'.deleted_at'])
            ->from(UserProfile::tableName())
            ->where([UserProfile::tableName().'.attivo' => UserProfile::STATUS_DEACTIVATED])
            ->andWhere([UserProfile::tableName().'.deleted_at' => null]);

        $this->setBulletCount(
            $this->makeBulletCounter(
                Yii::$app->getUser()->getId(), AmosAdmin::instance()->model('UserProfile'), $query
            )
        );
    }
}