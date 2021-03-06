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


namespace AD7six\Dsn\Wrapper\CakePHP\V3;

use AD7six\Dsn\Wrapper\Dsn;

/**
 * LogDsn
 *
 */
class LogDsn extends Dsn
{

/**
 * defaultOptions
 *
 * @var array
 */
    protected $defaultOptions = [
        'keyMap' => [
            'scheme' => 'className'
        ],
        'replacements' => [
            '/LOGS/' => LOGS
        ]
    ];

/**
 * getClassName
 *
 * Return the adapter if there is one, else return the scheme
 *
 * @return string
 */
    public function getClassName()
    {
        $adapter = $this->getAdapter();

        if ($adapter) {
            return $adapter;
        }

        $scheme = $this->dsn->scheme;

        return 'Cake\Log\Engine\\' . ucfirst($scheme) . 'Log';
    }

/**
 * getLevels
 *
 * If it's defined, return as an array
 *
 * @return array
 */
    public function getLevels()
    {
        $return = $this->dsn->levels;

        if ($return === null) {
            return;
        }
        return explode(',', $return);
    }

/**
 * getProbability
 *
 * @return int
 */
    public function getProbability()
    {
        $return = $this->dsn->probability;

        if ($return === null) {
            return;
        }
        return (int) $return;
    }

/**
 * getSerialize
 *
 * @return bool
 */
    public function getSerialize()
    {
        $return = $this->dsn->serialize;

        if ($return === null) {
            return;
        }
        return (bool) $return;
    }

/**
 * parse a url as a log dsn
 *
 * @param string $url
 * @param array $options
 * @return array
 */
    public static function parse($url, $options = [])
    {
        $inst = new LogDsn($url, $options);

        return $inst->toArray();
    }
}
