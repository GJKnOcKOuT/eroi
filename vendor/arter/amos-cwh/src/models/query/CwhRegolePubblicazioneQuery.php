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
 * @package    arter-cwh
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\cwh\models\query;


use arter\amos\cwh\AmosCwh;
use arter\amos\cwh\models\CwhRegolePubblicazione;
use yii\db\ActiveQuery;

class CwhRegolePubblicazioneQuery extends ActiveQuery
{

    /**
     * exclude Rule 1 (Public to all users) if the logged user has not the role to allow using rule 1
     * @return self $this
     */
    public function filterByRole()
    {

        $roleToCheck = AmosCwh::getInstance()->regolaPubblicazioneFilterRole;
        if (!\Yii::$app->getUser()->can($roleToCheck)) {
            $this->andWhere([
                'not', ['id' => CwhRegolePubblicazione::ALL_USERS]
            ]);
        }

        return $this;

    }

    /**
     * exclude Rules 2 and 4 (to all users based on tags and to all user based on network and tags)
     * @return self $this
     */
    public function excludeTag()
    {
        $this->andWhere(['not in', 'id', [CwhRegolePubblicazione::ALL_USERS_WITH_TAGS, CwhRegolePubblicazione::ALL_USERS_IN_DOMAINS_WITH_TAGS]]);
        return $this;
    }

    /**
     * If working under a specific network scope (eg. community dashboard)
     * exclude Rules 1 and 2 (to all users and based on tags and to all user based on tags)
     * selectable only rule 3 (all users in domain) and 4 if tag module is present(all users in domain with matching tags)
     * @return self $this
     */
    public function onlyNetwork()
    {
        $this->andWhere(['not in', 'id', [CwhRegolePubblicazione::ALL_USERS, CwhRegolePubblicazione::ALL_USERS_WITH_TAGS]]);
        return $this;
    }

}
