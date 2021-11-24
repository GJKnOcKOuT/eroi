<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


namespace PayPal\Api;

/**
 * Class CreateProfileResponse
 *
 * Response schema for create profile api
 *
 * @package PayPal\Api
 *
 * @property string id
 */
class CreateProfileResponse extends WebProfile
{
    /**
     * ID of the payment web experience profile.
     * 
     *
     * @param string $id
     * 
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * ID of the payment web experience profile.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

}
