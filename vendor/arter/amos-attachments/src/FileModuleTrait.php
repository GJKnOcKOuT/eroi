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
 * @package    arter\amos\attachments
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\attachments;

/**
 * Class FileModuleTrait
 * @package arter\amos\attachments
 */
trait FileModuleTrait
{
    /**
     * @var null|\arter\amos\attachments\FileModule
     */
    private $_module = null;

    /**
     * @return null|\arter\amos\attachments\FileModule
     * @throws \Exception
     */
    protected function getModule()
    {
        if ($this->_module == null) {
            $this->_module = \Yii::$app->getModule(FileModule::getModuleName());
        }

        if (!$this->_module) {
            throw new \Exception(FileModule::t('amosattachments', "amos-attachments module not found, may be you didn't add it to your config?"));
        }

        return $this->_module;
    }
}
