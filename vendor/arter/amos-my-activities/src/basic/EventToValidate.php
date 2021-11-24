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
 * @package    arter\amos\myactivities\basic
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\myactivities\basic;

use arter\amos\events\models\Event;
use arter\amos\events\models\search\EventSearch;

/**
 * Class EventToValidate
 * @package arter\amos\myactivities\basic
 */
class EventToValidate extends EventSearch implements MyActivitiesModelsInterface
{
    /**
     * @return string
     */
    public function getSearchString()
    {
        return $this->getTitle();
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function getCreatorNameSurname()
    {
        return (!is_null($this->createdUserProfile) ? $this->createdUserProfile->getNomeCognome() : '');
    }

    /**
     * @return Event
     */
    public function getWrappedObject()
    {
        return Event::findOne($this->id);
    }

    /**
     * @inheritdoc
     */
    public function getViewUrl()
    {
        return 'events/event/view';
    }
}
