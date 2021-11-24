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
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Wraps a standard PHP array in an iterator.
 *
 * @author Chris Corbyn
 */
class Swift_Mailer_ArrayRecipientIterator implements Swift_Mailer_RecipientIterator
{
    /**
     * The list of recipients.
     *
     * @var array
     */
    private $recipients = [];

    /**
     * Create a new ArrayRecipientIterator from $recipients.
     */
    public function __construct(array $recipients)
    {
        $this->recipients = $recipients;
    }

    /**
     * Returns true only if there are more recipients to send to.
     *
     * @return bool
     */
    public function hasNext()
    {
        return !empty($this->recipients);
    }

    /**
     * Returns an array where the keys are the addresses of recipients and the
     * values are the names. e.g. ('foo@bar' => 'Foo') or ('foo@bar' => NULL).
     *
     * @return array
     */
    public function nextRecipient()
    {
        return array_splice($this->recipients, 0, 1);
    }
}
