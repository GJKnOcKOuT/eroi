<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */

namespace app\modules\cms\components;


class AdminUser extends \luya\admin\components\AdminUser
{
    public function init()
    {
        parent::init();
        $this->idParam = '__luyaAdmin_id';

    }
}