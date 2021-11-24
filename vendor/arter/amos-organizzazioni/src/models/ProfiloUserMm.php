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
 * @package    arter\amos\organizzazioni\models
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\organizzazioni\models;

use arter\amos\organizzazioni\Module;

/**
 * Class ProfiloUserMm
 * This is the model class for table "profilo_user_mm".
 * @package arter\amos\organizzazioni\models
 */
class ProfiloUserMm extends \arter\amos\organizzazioni\models\base\ProfiloUserMm
{
    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_REJECTED = 'REJECTED';
    const STATUS_WAITING_REQUEST_CONFIRM = 'WAITING_REQUEST_CONFIRM';
    const STATUS_WAITING_OK_ORGANIZATION_REFEREE = 'REQUEST_SENT';
    const STATUS_WAITING_OK_USER = 'INVITED';
    const STATUS_INVITE_IN_PROGRESS = 'INVITING';

    /**
     * Return all statuses of the organization users.
     * @return array
     */
    public static function getUserStates()
    {
        return [
            self::STATUS_ACTIVE,
            self::STATUS_REJECTED,
            self::STATUS_WAITING_REQUEST_CONFIRM,
            self::STATUS_WAITING_OK_ORGANIZATION_REFEREE,
            self::STATUS_WAITING_OK_USER,
            self::STATUS_INVITE_IN_PROGRESS
        ];
    }

    /**
     * @inheritdoc
     */
    public function getModelModuleName()
    {
        return Module::getModuleName();
    }

    /**
     * @inheritdoc
     */
    public function getModelControllerName()
    {
        return 'profilo';
    }
}
