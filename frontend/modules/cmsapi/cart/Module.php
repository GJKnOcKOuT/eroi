<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */

namespace app\modules\cmsapi\cart;

use luya\base\CoreModuleInterface;

/**
 * Sitemap Admin Module.
 *
 * 
 * @author
 * @since 1.0.0
 */
final class Module extends \luya\base\Module implements CoreModuleInterface {

    public $urlRules = [
        ['pattern' => 'api/v1/cart-add', 'route' => 'cmscartapi/cmsapi/add'],
        ['pattern' => 'api/v1/cart-get', 'route' => 'cmscartapi/cmsapi/get'],
    ];

}
