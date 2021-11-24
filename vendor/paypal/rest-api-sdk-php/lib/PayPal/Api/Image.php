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

use PayPal\Common\PayPalModel;

/**
 * Class Image
 *
 * @package PayPal\Api
 *
 * @property string image
 */
class Image extends PayPalModel
{
    /**
     * List of invoices belonging to a merchant.
     *
     * @param string $imageBase64String
     * 
     * @return $this
     */
    public function setImage($imageBase64String)
    {
        $this->image = $imageBase64String;
        return $this;
    }

    /**
     * Get Image as Base-64 encoded String
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Stores the Image to file
     *
     * @param string $name File Name
     * @return string File name
     */
    public function saveToFile($name = null)
    {
        // Self Generate File Location
        if (!$name) {
            $name = uniqid() . '.png';
        }
        // Save to File
        file_put_contents($name, base64_decode($this->getImage()));
        return $name;
    }

}
