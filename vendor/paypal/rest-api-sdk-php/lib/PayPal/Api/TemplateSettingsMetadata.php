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
 * Class TemplateSettingsMetadata
 *
 * Settings Metadata per field in template
 *
 * @package PayPal\Api
 *
 * @property bool hidden
 */
class TemplateSettingsMetadata extends PayPalModel
{
    /**
     * Indicates whether this field should be hidden. default is false
     *
     * @param bool $hidden
     * 
     * @return $this
     */
    public function setHidden($hidden)
    {
        $this->hidden = $hidden;
        return $this;
    }

    /**
     * Indicates whether this field should be hidden. default is false
     *
     * @return bool
     */
    public function getHidden()
    {
        return $this->hidden;
    }

}
