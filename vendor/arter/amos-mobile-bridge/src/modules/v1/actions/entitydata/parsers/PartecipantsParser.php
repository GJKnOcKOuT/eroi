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


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace arter\amos\mobile\bridge\modules\v1\actions\entitydata\parsers;

use arter\amos\admin\models\UserProfile;

/**
 * Description of PartecipantsParser
 *
 * @author stefano
 */
class PartecipantsParser {

    public static function parseItem($item) {
        $newItem = [];

        //Creator profile
        $owner = UserProfile::findOne(['user_id' => $item->user_id]);

        //Fill fields from item usable in app
        $newItem['fields'] = [
            'id' => $item->user_id,
            'status' => $item->status,
            'role' => $item->role,
            'invited_at' => $item->invited_at,
            'invitation_accepted_at' => $item->invitation_accepted_at,
            'invitation_partner_of' => $item->invitation_partner_of,
            'nome' => $owner->nome,
            'cognome' => $owner->cognome,
            'presentazione_breve' => $owner->presentazione_breve,
            'avatarUrl' => $owner->avatarWebUrl,
        ];


        return $newItem;
    }

}
