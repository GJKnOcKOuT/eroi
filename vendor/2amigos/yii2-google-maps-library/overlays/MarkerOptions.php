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
 *
 * MarkerOptions.php
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 */

namespace dosamigos\google\maps\overlays;


use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\ObjectAbstract;
use dosamigos\google\maps\OptionsTrait;
use dosamigos\google\maps\Point;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

/**
 * MarkerOptions
 *
 * Eases the configuration of a marker
 *
 * @property Point anchorPoint The offset from the marker's position to the tip of an InfoWindow that has been opened
 * with the marker as anchor.
 * @property string animation Which animation to play when marker is added to a map.
 * @property boolean clickable If true, the marker receives mouse and touch events. Default value is true.
 * @property boolean crossOnDrag If false, disables cross that appears beneath the marker when dragging. This option is
 * true by default.
 * @property string cursor Mouse cursor to show on hover
 * @property boolean draggable If true, the marker can be dragged. Default value is false.
 * @property string|Icon|Symbol icon Icon for the foreground. If a string is provided, it is treated as though it were
 * an Icon with the string as url.
 * @property string map Map on which to display Marker.
 * @property int opacity The marker's opacity between 0.0 and 1.0.
 * @property boolean optimized Optimization renders many markers as a single static element. Optimized rendering is
 * enabled by default. Disable optimized rendering for animated GIFs or PNGs, or when each marker must be rendered as a
 * separate DOM element (advanced usage only).
 * @property LatLng position Marker position. Required.
 * @property MarkerShape shape Image map region definition used for drag/click.
 * @property string title Rollover text
 * @property boolean visible If true, the marker is visible
 * @property int zIndex All markers are displayed on the map in order of their zIndex, with higher values displaying in
 * front of markers with lower values. By default, markers are displayed according to their vertical position on screen,
 * with lower markers appearing in front of markers further up the screen.
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\google\maps
 */
class MarkerOptions extends ObjectAbstract
{
    use OptionsTrait;

    /**
     * @inheritdoc
     *
     * @param array $config
     */
    public function __construct($config = [])
    {

        $this->options = ArrayHelper::merge(
            [
                'anchorPoint' => null,
                'animation' => null,
                'clickable' => null,
                'crossOnDrag' => null,
                'cursor' => null,
                'draggable' => null,
                'icon' => null,
                'label' => null,
                'map' => null,
                'opacity' => null,
                'optimized' => null,
                'position' => null,
                'shape' => null,
                'title' => null,
                'visible' => null,
                'zIndex' => null,
            ],
            $this->options
        );

        parent::__construct($config);
    }

    /**
     * Sets the map option attribute.
     *
     * @param string $value
     */
    public function setMap($value)
    {
        $this->options['map'] = new JsExpression($value);
    }

    /**
     * Sets the coordinate object of the marker. Required.
     *
     * @param LatLng $coord
     */
    public function setPosition(LatLng $coord)
    {
        $this->options['position'] = $coord;
    }

    /**
     * Sets the anchor point. Is the offset from the marker's position to the tip of an InfoWindow that has been opened
     * with the marker as anchor.
     *
     * @param Point $point
     */
    public function setAnchorPoint(Point $point)
    {
        $this->options['anchorPoint'] = $point;
    }

    /**
     * Sets the marker shape.
     *
     * @param MarkerShape $shape
     */
    public function setShape(MarkerShape $shape)
    {
        $this->options['shape'] = $shape;
    }

    /**
     * Sets the animation of the marker
     *
     * @param $animation
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function setAnimation($animation)
    {
        if (!in_array($animation, [Animation::BOUNCE, Animation::DROP])) {
            throw new InvalidConfigException('Unknown animation');
        }
        $this->options['animation'] = new JsExpression($animation);
    }

    /**
     * Sets the marker label.
     *
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->options['label'] = $label;
    }

    /**
     * Returns the latitude of marker position
     * @return mixed
     */
    public function getLat()
    {
        return $this->position instanceof LatLng ? $this->position->getLat() : null;
    }

    /**
     * Returns the longitude of marker position
     * @return mixed
     */
    public function getLng()
    {
        return $this->position instanceof LatLng ? $this->position->getLng() : null;
    }
} 
