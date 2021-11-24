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
 * @package    arter\amos\een\config
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

return [
    'params' => [
        //active the search
        'searchParams' => [
            'een-partnership-proposal' => true,
            'een-expr-of-interest' => true,
            'een-tag-een' => true,
        ],
        //active the order
        'orderParams' => [
            'een' => [
                'enable' => true,
                'default_field' => 'datum_update',
                'order_type' => SORT_DESC
            ]
        ],
    ]
];
