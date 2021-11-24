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
 * @package    arter\amos\admin\config
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

return [
    'components' => [
        // List of component configurations
        'formatter' => [
            'class' => 'arter\amos\core\formatter\Formatter',
        ],
        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
            'siteKey' => '',
            'secret' => 'Z01Ak_2017',
        ],
    ],
    'params' => [
        // Active the search
        'searchParams' => [
            'user-profile' => [
                'enable' => true
            ]
        ],
        
        // Active the order
        'orderParams' => [
            'user-profile' => [
                'enable' => true,
                'fields' => [
                    'nome',
                    'cognome',
                    'surnameName',
                    'prevalentPartnership',
                    'created_at'
                ],
                'default_field' => 'surnameName',
                'order_type' => SORT_ASC
            ]
        ]
    ]
];
