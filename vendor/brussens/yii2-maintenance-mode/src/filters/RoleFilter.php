<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**
 * @link https://github.com/brussens/yii2-maintenance-mode
 * @copyright Copyright (c) since 2015 Dmitry Brusensky
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace brussens\maintenance\filters;

use brussens\maintenance\Filter;
use yii\web\User;

/**
 * Class RoleFilter
 * @package brussens\maintenance\filters
 */
class RoleFilter extends Filter
{
    /**
     * @var array
     */
    public $roles;
    /**
     * @var User
     */
    protected $user;

    /**
     * RoleChecker constructor.
     * @param User $user
     * @param array $config
     */
    public function __construct(User $user, array $config = [])
    {
        $this->user = $user;
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (is_string($this->roles)) {
            $this->roles = [$this->roles];
        }
        parent::init();
    }

    /**
     * @return bool
     */
    public function isAllowed()
    {
        if (is_array($this->roles) && !empty($this->roles)) {
            foreach ($this->roles as $role) {
                if ($this->user->can($role)) {
                    return true;
                }
            }
        }
        return false;
    }
}