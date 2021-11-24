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


namespace PayPal\Security;

/**
 * Class Cipher
 *
 * Helper class to encrypt/decrypt data with secret key
 *
 * @package PayPal\Security
 */
class Cipher
{
    private $secretKey;

    /**
     * Fixed IV Size
     */
    const IV_SIZE = 16;

    public function __construct($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    /**
     * Encrypts the input text using the cipher key
     *
     * @param $input
     * @return string
     */
    public function encrypt($input)
    {
        // Create a random IV. Not using mcrypt to generate one, as to not have a dependency on it.
        $iv = substr(uniqid("", true), 0, Cipher::IV_SIZE);
        // Encrypt the data
        $encrypted = openssl_encrypt($input, "AES-256-CBC", $this->secretKey, 0, $iv);
        // Encode the data with IV as prefix
        return base64_encode($iv . $encrypted);
    }

    /**
     * Decrypts the input text from the cipher key
     *
     * @param $input
     * @return string
     */
    public function decrypt($input)
    {
        // Decode the IV + data
        $input = base64_decode($input);
        // Remove the IV
        $iv = substr($input, 0, Cipher::IV_SIZE);
        // Return Decrypted Data
        return openssl_decrypt(substr($input, Cipher::IV_SIZE), "AES-256-CBC", $this->secretKey, 0, $iv);
    }
}
