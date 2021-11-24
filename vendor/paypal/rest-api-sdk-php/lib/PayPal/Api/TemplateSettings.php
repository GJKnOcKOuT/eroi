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
 * Class TemplateSettings
 *
 * Settings per template
 *
 * @package PayPal\Api
 *
 * @property string field_name
 * @property \PayPal\Api\TemplateSettingsMetadata display_preference
 */
class TemplateSettings extends PayPalModel
{
    /**
     * The field name (for any field in template_data) for which the corresponding display preferences will be mapped to.
     *
     * @param string $field_name
     * 
     * @return $this
     */
    public function setFieldName($field_name)
    {
        $this->field_name = $field_name;
        return $this;
    }

    /**
     * The field name (for any field in template_data) for which the corresponding display preferences will be mapped to.
     *
     * @return string
     */
    public function getFieldName()
    {
        return $this->field_name;
    }

    /**
     * Settings metadata for each field.
     *
     * @param \PayPal\Api\TemplateSettingsMetadata $display_preference
     * 
     * @return $this
     */
    public function setDisplayPreference($display_preference)
    {
        $this->display_preference = $display_preference;
        return $this;
    }

    /**
     * Settings metadata for each field.
     *
     * @return \PayPal\Api\TemplateSettingsMetadata
     */
    public function getDisplayPreference()
    {
        return $this->display_preference;
    }

}
