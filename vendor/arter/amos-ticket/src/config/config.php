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
 * @package    arter\amos\ticket\config
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

return [
    'params' => [
        'img-default' => '/img/defaultProfilo.png',
        'site_publish_enabled' => false,
        'site_featured_enabled' => false,
        //active the search
        'searchParams' => [
            'ticket' => [
                'enable' => true,
            ],
            'ticket-categorie' => [
                'enable' => true,
            ],
        ],

        //active the order
        /* 'orderParams' => [
             'ticket' => [
                 'enable' => true,
                 'fields' => [
                     'titolo',
                     'data_pubblicazione'
                 ],
                 'default_field' => 'data_pubblicazione',
                 'order_type' => SORT_DESC
             ]
         ],*/

        //active the introduction
        /* 'introductionParams' => [
             'ticket' => [
                 'enable' => true,
             ]
         ]*/
    ]
];
