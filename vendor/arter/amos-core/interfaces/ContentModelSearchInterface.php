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
 * @package    arter\amos\core\interfaces
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\interfaces;

use yii\data\BaseDataProvider;
use yii\db\ActiveQuery;

/**
 * Interface ContentModelSearchInterface
 * @package arter\amos\core\interfaces
 */
interface ContentModelSearchInterface
{
    /**
     * This method define the search default order.
     * @param BaseDataProvider $dataProvider
     * @return BaseDataProvider
     */
    public function searchDefaultOrder($dataProvider);

    /**
     * This method returns the ActiveQuery object that contains the query to retrieve logged user own interest contents.
     * @param array $params
     * @return ActiveQuery
     */
    public function searchOwnInterestsQuery($params);

    /**
     * This method returns the ActiveQuery object that contains the query to retrieve logged user all contents.
     * @param array $params
     * @return ActiveQuery
     */
    public function searchAllQuery($params);

    /**
     * This method returns the ActiveQuery object that contains the query to retrieve created by logged user contents.
     * @param array $params
     * @return ActiveQuery
     */
    public function searchCreatedByMeQuery($params);

    /**
     * This method returns the ActiveQuery object that contains the query to retrieve logged user to validate contents.
     * @param array $params
     * @return ActiveQuery
     */
    public function searchToValidateQuery($params);
}
