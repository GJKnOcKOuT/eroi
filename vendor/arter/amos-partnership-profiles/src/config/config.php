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
 * @package    arter\amos\partnershipprofiles\config
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

return [
    'params' => [
        // Activate the search
        'searchParams' => [
            'partnership-profiles' => [
                'enable' => true
            ],
            'expressions-of-interest' => [
                'enable' => true
            ]
        ],

        // Activate the order
        'orderParams' => [
            'partnership-profiles' => [
                'enable' => true,
                'fields' => [
                    'title',
                    'updated_at',
//                    'short_description',
                    'partnership_profile_date',
                    // TODO rimane da implementare il campo relativo all'ordinamento per data di scadenza.
                ],
                'default_field' => 'updated_at',
                'order_type' => SORT_DESC
            ],
//            'expressions-of-interest' => [
//                'enable' => true,
//                'fields' => [
////                    'status',
//                    'partnershipProfile.title',
//                ],
//                'default_field' => 'id',
//                'order_type' => SORT_ASC
//            ]
        ]
    ]
];
