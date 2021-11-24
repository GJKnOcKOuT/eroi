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
 * Validates a number as defined by the CSS spec.
 */
class HTMLPurifier_AttrDef_CSS_Number extends HTMLPurifier_AttrDef
{

    /**
     * Indicates whether or not only positive values are allowed.
     * @type bool
     */
    protected $non_negative = false;

    /**
     * @param bool $non_negative indicates whether negatives are forbidden
     */
    public function __construct($non_negative = false)
    {
        $this->non_negative = $non_negative;
    }

    /**
     * @param string $number
     * @param HTMLPurifier_Config $config
     * @param HTMLPurifier_Context $context
     * @return string|bool
     * @warning Some contexts do not pass $config, $context. These
     *          variables should not be used without checking HTMLPurifier_Length
     */
    public function validate($number, $config, $context)
    {
        $number = $this->parseCDATA($number);

        if ($number === '') {
            return false;
        }
        if ($number === '0') {
            return '0';
        }

        $sign = '';
        switch ($number[0]) {
            case '-':
                if ($this->non_negative) {
                    return false;
                }
                $sign = '-';
            case '+':
                $number = substr($number, 1);
        }

        if (ctype_digit($number)) {
            $number = ltrim($number, '0');
            return $number ? $sign . $number : '0';
        }

        // Period is the only non-numeric character allowed
        if (strpos($number, '.') === false) {
            return false;
        }

        list($left, $right) = explode('.', $number, 2);

        if ($left === '' && $right === '') {
            return false;
        }
        if ($left !== '' && !ctype_digit($left)) {
            return false;
        }

        // Remove leading zeros until positive number or a zero stays left
        if (ltrim($left, '0') != '') {
            $left = ltrim($left, '0');
        } else {
            $left = '0';
        }

        $right = rtrim($right, '0');

        if ($right === '') {
            return $left ? $sign . $left : '0';
        } elseif (!ctype_digit($right)) {
            return false;
        }
        return $sign . $left . '.' . $right;
    }
}

// vim: et sw=4 sts=4
