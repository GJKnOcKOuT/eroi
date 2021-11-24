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
 */

namespace arter\amos\een\models;


use arter\amos\een\AmosEen;
use yii\base\Model;

class ProposalForm extends Model
{

    public $een_network_node_id;
    public $text;
    public $interestedTo;
    public $user_id;

    /**
     *
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @return array
     */
    public function getScelte()
    {
        return [
            '1' => AmosEen::t('amoseen', 'Collaborazioni commerciali'),
            '2' => AmosEen::t('amoseen', 'Ricerca / Offerta di tecnologie innovative'),
            '3' => AmosEen::t('amoseen', 'partecipazione a programmi internazionali di ricerca')
        ];
    }

    /**
     * @return array
     */
    public function getLabels()
    {
        return [
            'een_network_node_id' => AmosEen::t('amoseen', "In quale regione operi abitualmente?"),
            'text' => AmosEen::t('amoseen', "Descrivi in sintesi la proposta di collaborazione che vorresti diffondere"),
            'interestedTo' => AmosEen::t('amoseen', "Sono interessato prevalentemente a:"),
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['een_network_node_id', 'text', 'interestedTo', 'user_id'], 'safe'],
            [['een_network_node_id', 'text', 'interestedTo', 'user_id'], 'required']
        ];
    }
}