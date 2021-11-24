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


namespace PayPal\Api;

use PayPal\Common\PayPalModel;

/**
 * Class Notification
 *
 * Email/SMS notification.
 *
 * @package PayPal\Api
 *
 * @property string subject
 * @property string note
 * @property bool send_to_merchant
 * @property string[] cc_emails
 */
class Notification extends PayPalModel
{
    /**
     * Subject of the notification.
     *
     * @param string $subject
     * 
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * Subject of the notification.
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Note to the payer.
     *
     * @param string $note
     * 
     * @return $this
     */
    public function setNote($note)
    {
        $this->note = $note;
        return $this;
    }

    /**
     * Note to the payer.
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Indicates whether to send a copy of the email to the merchant.
     *
     * @param bool $send_to_merchant
     * 
     * @return $this
     */
    public function setSendToMerchant($send_to_merchant)
    {
        $this->send_to_merchant = $send_to_merchant;
        return $this;
    }

    /**
     * Indicates whether to send a copy of the email to the merchant.
     *
     * @return bool
     */
    public function getSendToMerchant()
    {
        return $this->send_to_merchant;
    }

    /**
     * Applicable for invoices created with Cc emails. If this field is not in the body, all the cc email addresses added as part of the invoice shall be notified else this field can be used to limit the list of email addresses. Note: additional email addresses are not supported.
     *
     * @param string[] $cc_emails
     * 
     * @return $this
     */
    public function setCcEmails($cc_emails)
    {
        $this->cc_emails = $cc_emails;
        return $this;
    }

    /**
     * Applicable for invoices created with Cc emails. If this field is not in the body, all the cc email addresses added as part of the invoice shall be notified else this field can be used to limit the list of email addresses. Note: additional email addresses are not supported.
     *
     * @return string[]
     */
    public function getCcEmails()
    {
        return $this->cc_emails;
    }

    /**
     * Append CcEmails to the list.
     *
     * @param string $string
     * @return $this
     */
    public function addCcEmail($string)
    {
        if (!$this->getCcEmails()) {
            return $this->setCcEmails(array($string));
        } else {
            return $this->setCcEmails(
                array_merge($this->getCcEmails(), array($string))
            );
        }
    }

    /**
     * Remove CcEmails from the list.
     *
     * @param string $string
     * @return $this
     */
    public function removeCcEmail($string)
    {
        return $this->setCcEmails(
            array_diff($this->getCcEmails(), array($string))
        );
    }

}
