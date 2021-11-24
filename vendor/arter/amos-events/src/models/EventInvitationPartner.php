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
 * @package    openinnovation\organizations\controllers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\events\models;

use arter\amos\events\AmosEvents;
use yii\base\Model;
use yii\web\UploadedFile;

class EventInvitationPartner extends Model
{

    public $name;
    public $surname;
    public $fiscal_code;
    public $email;

    public function rules()
    {
        return [
            // [['name', 'surname', 'fiscal_code', 'email'], 'required', 'when' => function($mod) {
            //     return $mod->name || $mod->surname || $mod->fiscal_code || $mod->email;
            // }],
            [['email'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['fiscal_code'], 'string', 'max' => 16],
            [['name', 'surname'], 'string', 'max' => 50],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email' => AmosEvents::txt('#email'),
            'fiscal_code' => AmosEvents::txt('#fiscalcode'),
            'name' => AmosEvents::txt('#name'),
            'surname' => AmosEvents::txt('#surname'),
        ];
    }

}