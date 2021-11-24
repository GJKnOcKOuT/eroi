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

use yii\base\InvalidConfigException;
use yii\base\BaseObject;

/**
 * Point
 *
 * Google maps point
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\google\maps
 */
class Point extends BaseObject
{
    /**
     *
     * The x coordinate
     * @var int x
     */
    private $_x;
    /**
     *
     * The y coordinate.
     * @var int y
     */
    private $_y;

    /**
     * @inheritdoc
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        if (empty($this->_x) || empty($this->_y)) {
            throw new InvalidConfigException('"x" and "y" cannot be null.');
        }
        if (!is_numeric($this->_x) || !is_numeric($this->_y)) {
            throw new InvalidConfigException('"x" and "y" must be a numeric string or a number!');
        }
        parent::init();
    }

    /**
     * Sets x coordinate ght of the Point
     *
     * @param $value
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function setX($value)
    {
        if (!is_numeric($value)) {
            throw new InvalidConfigException('"x" must be a numeric string or a number!');
        }

        $this->_x = $value;
    }

    /**
     * Sets the y coordinate of the Point
     *
     * @param $value
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function setY($value)
    {
        if (!is_numeric($value)) {
            throw new InvalidConfigException('"y" must be a numeric string or a number!');
        }

        $this->_y = $value;
    }

    /**
     *
     * returns array representation of the size
     */
    public function asArray()
    {
        return ['x' => $this->_x, 'y' => $this->_y];
    }

    /**
     * @return string Javascript code to return the Point
     */
    public function getJs()
    {
        return "new google.maps.Point({$this->_x}, {$this->_y})";
    }
}
