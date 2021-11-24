<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\tickets\models
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\modules\tickets\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * ContactForm is the model behind the contact form.
 * @package frontend\models
 */
class ContactForm extends Model
{
    /**
     * @var string Name
     */
    public $first_name;

    /**
     * @var string Name
     */
    public $surname;

    /**
     * @var string Telephone number
     */
    public $telephone;

    /**
     * @var string Email address
     */
    public $email;

    /**
     * @var string Email subject
     */
    public $subject;

    /**
     * @var string Email body
     */
    public $message;

    /**
     * @var string Captcha
     */
    public $verifyCode;

    /**
     * @var string Attachement
     */
    public $attachment;

    /**
     * @var integer Ticket Type
     */
    public $ticketType;
    const TICKET_TYPE_TECNICO = "TICKET_TYPE_TECNICO";
    const TICKET_TYPE_AMMINISTRATIVO = "TICKET_TYPE_AMMINISTRATIVO";


    /**
     * @return array
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['first_name', 'surname', 'email', 'subject', 'message'], 'required'],
            [['subject'], 'safe'],
            // email has to be a valid email address
            ['email', 'email'],
            ['attachment', 'file'],
            // verifyCode needs to be entered correctly
//            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'subject' => Yii::t('amosapp', 'Oggetto'),
            'first_name' =>  Yii::t('amosapp', 'Nome'),
            'surname' =>  Yii::t('amosapp', 'Cognome'),
            'verifyCode' => Yii::t('amosapp', 'Codice verifica'),
            'message' => Yii::t('amosapp', 'Messaggio'),
            'ticketType' => Yii::t('amosapp', 'Tipo di ticket'),
            'attachment' => Yii::t('amosapp', 'Allegato'),
            'telephone' => Yii::t('amosapp', 'Telefono'),
        ];
    }



    public function spedisciEmailStandard($profile = null)
    {
        $emailTo = Yii::$app->params['assistance']['email'];
        $this->subject .= ' - TICKET';

        $file = UploadedFile::getInstance($this, 'attachment');
        $mail = Yii::$app->mailer
            ->compose(
                [
                    'html' => '@backend/modules/tickets/views/mail/info-html',
                ], [
                'model' => $this,
                'modelProfile' => $profile,
            ])
            ->setFrom([Yii::$app->params['supportEmailTicket'] => Yii::$app->name])
            ->setReplyTo([$this->email => $this->first_name . ' ' . $this->surname])
            ->setTo($emailTo)
            ->setSubject($this->subject);

        if($file) {
            $mail->attach($file->tempName,['fileName' => $file->name]);
        }

        return $mail->send();
    }

    public function __toString(){
        return \Yii::t('amosapp', "Contatta l'assistenza");
    }
}
