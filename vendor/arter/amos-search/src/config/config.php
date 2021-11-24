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
 * @package    arter\amos\search
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

return [
    'config' => [
        'modulesEnabled' => [
           'arter\amos\admin\AmosAdmin',
           'arter\amos\discussioni\AmosDiscussioni',
           'arter\amos\documenti\AmosDocumenti',
           'arter\amos\events\AmosEvents',
           'arter\amos\news\AmosNews',
           'arter\amos\partnershipprofiles\Module',
           'arter\amos\showcaseprojects\AmosShowcaseProjects',
           'arter\amos\een\AmosEen',
           'openinnovation\organizations\OpenInnovationOrganizations',
           'arter\amos\organizzazioni\Module',
           'arter\amos\community\AmosCommunity',
           'arter\amos\parternishipprofiles\Module',
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
