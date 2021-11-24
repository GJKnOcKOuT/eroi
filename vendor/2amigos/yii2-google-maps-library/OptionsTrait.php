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
 * @copyright Copyright (c) 2014 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dosamigos\google\maps;


/**
 * OptionsTrait
 *
 * Contains common functions for option classes.
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\google\maps
 */
trait OptionsTrait
{
    /**
     * @return string the js constructor of the object
     */
    public function getJs()
    {
        $name = $this->getName(false) ? "var {$this->getName()} = " : "";
        $end = $this->getName(false) ? ";" : "";
        $options = $this->getEncodedOptions();
        return "{$name}{$options}{$end}";
    }
} 