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
 * @package    arter\amos\dashboard
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\dashboard\models\search;

use arter\amos\dashboard\models\AmosUserDashboards;
use yii\db\ActiveQuery;

/**
 * AmosUserDashboardsSearch represents the model behind the search form about `arter\amos\dashboard\models\AmosUserDashboards`.
 */
class AmosUserDashboardsSearch extends AmosUserDashboards
{
    /**@return ActiveQuery */
    public function current($params)
    {
        $query = AmosUserDashboards::find();

        if (!($this->load($params) && $this->validate())) {
            return $query->andFilterWhere($params);
        }
    }

    public function rules()
    {
        return [
            [['id', 'user_id', 'slide', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['module', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
        ];
    }

}