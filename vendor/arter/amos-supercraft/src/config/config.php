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
 * @package    arter\amos\best\practice\config
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

return [
    'params' => [
        // Activate the search
        'searchParams' => [
            'super-craft' => [
                'enable' => true
            ]
        ],
        //active the order
        'orderParams' => [
            'super-craft' => [
                'enable' => true,
                'fields' => [
                    'title',
                    'created_at'
                ],
                'default_field' => 'created_at',
                'order_type' => SORT_DESC
            ]
        ],
    ],

];