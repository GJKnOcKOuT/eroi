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
 * @package    arter\amos\myactivities\models\search
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\myactivities\models\search;

use arter\amos\myactivities\AmosMyActivities;
use arter\amos\myactivities\basic\MyActivitiesModelsInterface;
use yii\base\Model;

/**
 * Class MyActivitiesModelSearch
 * @package arter\amos\myactivities\models\search
 */
class MyActivitiesModelSearch extends Model implements MyActivitiesModelsInterface
{
    public $createdAt;
    public $updatedAt;
    public $creatorNameSurname;
    public $searchString;
    public $orderType;
    public $wrappedObject;

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return mixed
     */
    public function getCreatorNameSurname()
    {
        return $this->creatorNameSurname;
    }

    /**
     * @return mixed
     */
    public function getSearchString()
    {
        return $this->searchString;
    }

    public function getWrappedObject()
    {
        return $this->wrappedObject;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['searchString'], 'safe'],
            [['orderType'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'searchString' => AmosMyActivities::t('amosmyactivities', 'Text search'),
            'orderType' => AmosMyActivities::t('amosmyactivities', 'Update date sort'),
        ];
    }
}
