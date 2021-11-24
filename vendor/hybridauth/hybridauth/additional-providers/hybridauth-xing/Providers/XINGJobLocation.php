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
 * XingJobLocation - Used to search for jobs in specific locations
 *
 * A geo coordinate in the format latitude, longitude, radius. Radius is specified in kilometers.
 * Example: “51.1084,13.6737,100”
 *
 */
class XingJobLocation
{
    private $lat;
    private $lon;
    private $radius;

    /**
     * XingJobLocation constructor.
     *
     * Create location that is used to query api in job search
     * @param  float $lat
     * @param  float $lon
     * @param  float $radius the radius size of the area search
     * @throws Exception
     */
    public function __construct( $lat, $lon, $radius )
    {
        $this->lat = $lat;
        $this->lon = $lon;
        $this->radius = $radius;
    }

    public function __toString() {
        return implode( ',', array( $this->lat, $this->lon, $this->radius ) );
    }
}

