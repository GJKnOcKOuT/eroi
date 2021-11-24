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

/**
 * Class RequestToJoinOrganizzazioniForReferees
 * @package arter\amos\myactivities\basic
 */
class RequestToJoinOrganizzazioniForReferees extends \arter\amos\organizzazioni\models\ProfiloUserMm implements MyActivitiesModelsInterface
{
    /**
     * @return string
     */
    public function getSearchString()
    {
        return ((!is_null($this->user) && !is_null($this->user->userProfile)) ? $this->user->userProfile->getNomeCognome() : '');
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
     */
    public function getCreatorNameSurname()
    {
        return (!is_null($this->createdUserProfile) ? $this->createdUserProfile->getNomeCognome() : '');
    }

    /**
     * @return \arter\amos\organizzazioni\models\ProfiloUserMm
     */
    public function getWrappedObject()
    {
        return \arter\amos\organizzazioni\models\ProfiloUserMm::findOne($this->id);
    }
}
