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
 * @package    arter\amos\seo
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
return [
    'config' => [
        'metaRobotsList' => [
            'noindex',
            'nofollow',
            'nosnippet',
            'noarchive',
            'unavailable_after',
            'noimageindex'
        ],
        'metaGooglebotList' => [
            'noindex',
            'nofollow',
            'nosnippet',
            'noarchive',
            'unavailable_after',
            'noimageindex'
        ],
        'modulesEnabled' => [// TODO da capire se possiamo recuperarli in altra maniera
            'arter\amos\news\AmosNews',
            'arter\amos\discussioni\AmosDiscussioni',
        ],
    ],
    'params' => [
        //active the search
        'searchParams' => [
        ],
        //active the order
        'orderParams' => [
        ],
    ]
];
