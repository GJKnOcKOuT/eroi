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
 * @package    arter\amos\sondaggi\models
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\sondaggi\models;

/**
 * Class SondaggiPubblicazione
 * This is the model class for table "sondaggi_pubblicazione".
 * @package arter\amos\sondaggi\models
 */
class SondaggiPubblicazione extends \arter\amos\sondaggi\models\base\SondaggiPubblicazione
{
    public $attivita;

    /**
     * @inheritdoc
     */
    public function representingColumn()
    {
        return [
            'ruolo'
        ];
    }

    /**
     * @param array $values
     */
    public function setOtherAttribute($values)
    {
        if (isset($values['Sondaggi']['mail_subject'])) {
            $this->mail_subject = $values['Sondaggi']['mail_subject'];
        }
        if (isset($values['Sondaggi']['mail_message'])) {
            $this->mail_message = $values['Sondaggi']['mail_message'];
        }
        if (isset($values['Sondaggi']['text_end'])) {
            $this->text_end = $values['Sondaggi']['text_end'];
        }
        if (isset($values['Sondaggi']['text_end_html'])) {
            $this->text_end_html = $values['Sondaggi']['text_end_html'];
        }
        if (isset($values['Sondaggi']['text_end_title'])) {
            $this->text_end_title = $values['Sondaggi']['text_end_title'];
        }
        if (isset($values['Sondaggi']['text_not_compilable'])) {
            $this->text_not_compilable = $values['Sondaggi']['text_not_compilable'];
        }
        if (isset($values['Sondaggi']['text_not_compilable_html'])) {
            $this->text_not_compilable_html = $values['Sondaggi']['text_not_compilable_html'];
        }
    }
}
