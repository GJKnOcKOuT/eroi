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


namespace PayPal\Exception;

/**
 * Class PayPalConnectionException
 *
 * @package PayPal\Exception
 */
class PayPalConnectionException extends \Exception
{
    /**
     * The url that was being connected to when the exception occured
     *
     * @var string
     */
    private $url;

    /**
     * Any response data that was returned by the server
     *
     * @var string
     */
    private $data;

    /**
     * Default Constructor
     *
     * @param string $url
     * @param string    $message
     * @param int    $code
     */
    public function __construct($url, $message, $code = 0)
    {
        parent::__construct($message, $code);
        $this->url = $url;
    }

    /**
     * Sets Data
     *
     * @param $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Gets Data
     *
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Gets Url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
