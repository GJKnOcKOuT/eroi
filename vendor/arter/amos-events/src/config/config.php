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
 * @package    arter\amos\events
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

return [
    'params' => [
        'site_publish_enabled' => false,
        'site_featured_enabled' => false,

        //active the search 
        'searchParams' => [
            'event' => [
                'enable' => true,
            ],
            'event-status' => [
                'enable' => true,
            ],
            'event-type' => [
                'enable' => true,
            ]
        ]
    ]
];
