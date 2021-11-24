<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\core\forms
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\forms;


use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Marker;
use arter\amos\core\utilities\MapsUtility;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

/**
 * Class MapWidget
 * @package arter\amos\core\forms
 */
class MapWidget extends Widget
{
    /**
     * @var array $coordinates - ['lat' => $latitude, 'lng' => $longitude]
     */
    public $coordinates = [] ;

    /**
     * @var string $markerTitle - to view on marker mouseover
     */
    public $markerTitle = '';

    /**
     * @var string $position - address for coordinates research - eg. 'Via NomeDellaVia 999, NomeCittà'
     */
    public $position;
    
    /**
     * @var string $placeId - google string that identify place - eg. ChIJ3REr3gtOfkcRLitxU655Ozw
     */
    public $placeId;

    /**
     * @var int $zoom - zoom if coordinates found (no default used)
     */
    public $zoom = 11;

    /**
     * @var int $zoomIfDefaultCenter - zoom in case default longitude and latitude are used (no coordinates)
     */
    public $zoomIfDefaultCenter = 10;

    /**
     * @var string $latitude - default latitude
     */
    public $latitude = '41.9102';

    /**
     * @var string $longitude - default longitude
     */
    public $longitude = '12.3959';

    /**
     * @var string $styles - custom style
     */
    public $styles;

    /**
     * @var string width
     */
    public $width = '100%';

    /**
     * @var string height
     */
    public $height = 200;

    /**
     * @inheritdoc
     */
    public function run()
    {

        if ($this->position){
            $gmap = MapsUtility::getMapPosition($this->position);
        } elseif ($this->placeId) {
            $gmap = MapsUtility::getMapPositionByPlaceId($this->placeId);
        } else {
            $gmap = $this->coordinates;
        }
        if (count($gmap)) {
            $lat = $gmap['lat'];
            $long = $gmap['lng'];
        } else {
            $lat = $this->latitude;
            $long = $this->longitude;
        }

        $coord = new LatLng(['lat' => $lat, 'lng' => $long]);

        $mapArray = [
            'center' => $coord,
            'width' => $this->width,
            'height' => $this->height,
            'zoom' => count($gmap) ? $this->zoom : $this->zoomIfDefaultCenter,
        ];

        if($this->styles){
            $mapArray = ArrayHelper::merge($mapArray, ['styles' => $this->styles]);
        }

        $map = new Map($mapArray);

        if (count($gmap)):
            $marker = new Marker([
                'position' => $coord,
                'title' => $this->markerTitle,
            ]);
            // Add marker to the map
            $map->addOverlay($marker);
        endif;

        return $map->display();
    }
}