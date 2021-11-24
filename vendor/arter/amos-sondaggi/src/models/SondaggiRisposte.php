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
use arter\amos\attachments\behaviors\FileBehavior;
use yii\helpers\ArrayHelper;

/**
 * Class SondaggiRisposte
 * This is the model class for table "sondaggi_risposte".
 * @package arter\amos\sondaggi\models
 */
class SondaggiRisposte extends \arter\amos\sondaggi\models\base\SondaggiRisposte
{

    public $attachment;
    public $attachment_multiple;

    /**
     * @inheritdoc
     */
    public function representingColumn()
    {
        return [
            'risposta_libera'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {

        $i = 1;
        if($this->sondaggi_domande_id == 11){
            $i = 0;
        }
        return ArrayHelper::merge(parent::rules(), [
            //[['regola_pubblicazione', 'destinatari', 'validatori'], 'safe'],
            [['domanda_'.$this->sondaggi_domande_id], 'file', 'maxFiles' => 0],
        ]);
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),
            [
                'fileBehavior' => [
                    'class' => FileBehavior::className()
                ],
            ]);
    }
}
