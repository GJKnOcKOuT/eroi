<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_invitations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\modules\aster_invitations;

use arter\amos\invitations\Module as AmosInvitationsModule;

/**
 * registry module definition class
 */
class Module extends AmosInvitationsModule
{
    public $controllerNamespace = 'arter\amos\invitations\controllers';
}
