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

/**
 * @link http://phe.me
 * @copyright Copyright (c) 2014 Pheme
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace pheme\settings\models;

/**
 * Interface SettingInterface
 * @package pheme\settings\models
 *
 * @author Aris Karageorgos <aris@phe.me>
 */
interface SettingInterface
{

    /**
     * Gets a combined map of all the settings.
     * @return array
     */
    public function getSettings();

    /**
     * Saves a setting
     *
     * @param $section
     * @param $key
     * @param $value
     * @param $type
     * @return bool
     * @throws \yii\base\InvalidConfigException
     */
    public function setSetting($section, $key, $value, $type);

    /**
     * Deletes a settings
     *
     * @param $key
     * @param $section
     * @return boolean True on success, false on error
     */
    public function deleteSetting($section, $key);

    /**
     * Deletes all settings! Be careful!
     * @return boolean True on success, false on error
     */
    public function deleteAllSettings();

    /**
     * Activates a setting
     *
     * @param $key
     * @param $section
     * @return boolean True on success, false on error
     */
    public function activateSetting($section, $key);

    /**
     * Deactivates a setting
     *
     * @param $key
     * @param $section
     * @return boolean True on success, false on error
     */
    public function deactivateSetting($section, $key);

    /**
     * Finds a single setting
     *
     * @param $key
     * @param $section
     * @return SettingInterface single setting
     */
    public function findSetting($section, $key);
}
