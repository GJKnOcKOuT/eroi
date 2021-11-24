<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */

namespace app\modules\cms\models;

use app\modules\cms\admin\Module;

class NavItem extends \luya\cms\models\NavItem
{

    /**
     * Before create event.
     */
    public function beforeCreate()
    {
        $this->timestamp_create = time();
        $this->timestamp_update = 0;
        $this->create_user_id   = Module::getAuthorUserId();
        $this->update_user_id   = Module::getAuthorUserId();
        $this->slugifyAlias();
    }

    /**
     * Before update event.
     */
    public function eventBeforeUpdate()
    {
        $this->timestamp_update = time();
        $this->update_user_id   = Module::getAuthorUserId();
        $this->slugifyAlias();
    }
}