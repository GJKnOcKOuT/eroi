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


/*
 * This file is part of composer/xdebug-handler.
 *
 * (c) Composer <https://github.com/composer>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Composer\XdebugHandler;

/**
 * @author John Stevenson <john-stevenson@blueyonder.co.uk>
 */
class PhpConfig
{
    /**
     * Use the original PHP configuration
     *
     * @return array PHP cli options
     */
    public function useOriginal()
    {
        $this->getDataAndReset();
        return array();
    }

    /**
     * Use standard restart settings
     *
     * @return array PHP cli options
     */
    public function useStandard()
    {
        if ($data = $this->getDataAndReset()) {
            return array('-n', '-c', $data['tmpIni']);
        }

        return array();
    }

    /**
     * Use environment variables to persist settings
     *
     * @return array PHP cli options
     */
    public function usePersistent()
    {
        if ($data = $this->getDataAndReset()) {
            $this->updateEnv('PHPRC', $data['tmpIni']);
            $this->updateEnv('PHP_INI_SCAN_DIR', '');
        }

        return array();
    }

    /**
     * Returns restart data if available and resets the environment
     *
     * @return array|null
     */
    private function getDataAndReset()
    {
        if ($data = XdebugHandler::getRestartSettings()) {
            $this->updateEnv('PHPRC', $data['phprc']);
            $this->updateEnv('PHP_INI_SCAN_DIR', $data['scanDir']);
        }

        return $data;
    }

    /**
     * Updates a restart settings value in the environment
     *
     * @param string $name
     * @param string|false $value
     */
    private function updateEnv($name, $value)
    {
        Process::setEnv($name, false !== $value ? $value : null);
    }
}
