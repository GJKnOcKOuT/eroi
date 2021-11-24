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


namespace AD7six\Dsn\Wrapper\CakePHP\V2;

use AD7six\Dsn\Wrapper\Dsn;

/**
 * EmailDsn
 *
 */
class EmailDsn extends Dsn
{

/**
 * defaultOptions
 *
 * @var array
 */
    protected $defaultOptions = [
        'keyMap' => [
            'scheme' => 'transport',
            'user' => 'username',
            'pass' => 'password',
            'path' => false
        ]
    ];

/**
 * getLayout
 *
 * Return the layout, if defined, as either a string or bool as appropriate
 *
 * @return mixed
 */
    public function getLayout()
    {
        $return = $this->dsn->layout;

        if ($return === null) {
            return;
        }

        if (!$return) {
            return false;
        }

        return $return;
    }

/**
 * getMessageId
 *
 * Return the message id, if defined, as either a string or bool as appropriate
 *
 * @return mixed
 */
    public function getMessageId()
    {
        $return = $this->dsn->messageId;

        if ($return === null) {
            return;
        }

        if ($return === '1') {
            return true;
        }

        if ($return === '0') {
            return false;
        }

        return $return;
    }

/**
 * getTemplate
 *
 * Return the template, if defined, as either a string or bool as appropriate
 *
 * @return mixed
 */
    public function getTemplate()
    {
        $return = $this->dsn->template;

        if ($return === null) {
            return;
        }

        if (!$return) {
            return false;
        }

        return $return;
    }

/**
 * getTimeout
 *
 * If specified, return the timeout as an integer
 *
 * @return int
 */
    public function getTimeout()
    {
        $timeout = $this->dsn->timeout;

        if ($timeout === null) {
            return;
        }

        return (int) $timeout;
    }

/**
 * getTransport
 *
 * Return the adapter if there is one, else return the scheme
 *
 * @return string
 */
    public function getTransport()
    {
        $adapter = $this->getAdapter();

        if ($adapter) {
            return $adapter;
        }

        return ucfirst($this->dsn->scheme);
    }

/**
 * parse a url as an email dsn
 *
 * @param string $url
 * @param array $options
 * @return array
 */
    public static function parse($url, $options = [])
    {
        $inst = new EmailDsn($url, $options);
        return $inst->toArray();
    }
}
