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
namespace dosamigos\google\maps\overlays;


use dosamigos\google\maps\OverlayTrait;
use yii\base\InvalidConfigException;

/**
 * Circle
 *
 * Object to render circles on the map.
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\google\maps
 */
class Circle extends CircleOptions
{
    use OverlayTrait;

    /**
     * @inheritdoc
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {

        if($this->center == null) {
            throw new InvalidConfigException('"center" cannot be null');
        }
    }

    /**
     * Returns the center of bounds
     * @return \dosamigos\google\maps\LatLng
     */
    public function getCenterOfBounds()
    {
        return $this->center;
    }

    /**
     * Returns the js code to create a rectangle on a map
     * @return string
     */
    public function getJs()
    {

        $js = $this->getInfoWindowJs();

        $js[] = "var {$this->getName()} = new google.maps.Circle({$this->getEncodedOptions()});";

        foreach ($this->events as $event) {
            /** @var \dosamigos\google\maps\Event $event */
            $js[] = $event->getJs($this->getName());
        }


        return implode("\n", $js);
    }
} 