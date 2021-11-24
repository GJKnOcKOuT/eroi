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


Swift_DependencyContainer::getInstance()
    ->register('transport.localdomain')
    // As SERVER_NAME can come from the user in certain configurations, check that
    // it does not contain forbidden characters (see RFC 952 and RFC 2181). Use
    // preg_replace() instead of preg_match() to prevent DoS attacks with long host names.
    ->asValue(!empty($_SERVER['SERVER_NAME']) && '' === preg_replace('/(?:^\[)?[a-zA-Z0-9-:\]_]+\.?/', '', $_SERVER['SERVER_NAME']) ? trim($_SERVER['SERVER_NAME'], '[]') : '127.0.0.1')

    ->register('transport.smtp')
    ->asNewInstanceOf('Swift_Transport_EsmtpTransport')
    ->withDependencies([
        'transport.buffer',
        'transport.smtphandlers',
        'transport.eventdispatcher',
        'transport.localdomain',
        'address.idnaddressencoder',
    ])

    ->register('transport.sendmail')
    ->asNewInstanceOf('Swift_Transport_SendmailTransport')
    ->withDependencies([
        'transport.buffer',
        'transport.eventdispatcher',
        'transport.localdomain',
    ])

    ->register('transport.loadbalanced')
    ->asNewInstanceOf('Swift_Transport_LoadBalancedTransport')

    ->register('transport.failover')
    ->asNewInstanceOf('Swift_Transport_FailoverTransport')

    ->register('transport.spool')
    ->asNewInstanceOf('Swift_Transport_SpoolTransport')
    ->withDependencies(['transport.eventdispatcher'])

    ->register('transport.null')
    ->asNewInstanceOf('Swift_Transport_NullTransport')
    ->withDependencies(['transport.eventdispatcher'])

    ->register('transport.buffer')
    ->asNewInstanceOf('Swift_Transport_StreamBuffer')
    ->withDependencies(['transport.replacementfactory'])

    ->register('transport.smtphandlers')
    ->asArray()
    ->withDependencies(['transport.authhandler'])

    ->register('transport.authhandler')
    ->asNewInstanceOf('Swift_Transport_Esmtp_AuthHandler')
    ->withDependencies(['transport.authhandlers'])

    ->register('transport.authhandlers')
    ->asArray()
    ->withDependencies([
        'transport.crammd5auth',
        'transport.loginauth',
        'transport.plainauth',
        'transport.ntlmauth',
        'transport.xoauth2auth',
    ])

    ->register('transport.smtputf8handler')
    ->asNewInstanceOf('Swift_Transport_Esmtp_SmtpUtf8Handler')

    ->register('transport.8bitmimehandler')
    ->asNewInstanceOf('Swift_Transport_Esmtp_EightBitMimeHandler')
    ->addConstructorValue('8BITMIME')

    ->register('transport.crammd5auth')
    ->asNewInstanceOf('Swift_Transport_Esmtp_Auth_CramMd5Authenticator')

    ->register('transport.loginauth')
    ->asNewInstanceOf('Swift_Transport_Esmtp_Auth_LoginAuthenticator')

    ->register('transport.plainauth')
    ->asNewInstanceOf('Swift_Transport_Esmtp_Auth_PlainAuthenticator')

    ->register('transport.xoauth2auth')
    ->asNewInstanceOf('Swift_Transport_Esmtp_Auth_XOAuth2Authenticator')

    ->register('transport.ntlmauth')
    ->asNewInstanceOf('Swift_Transport_Esmtp_Auth_NTLMAuthenticator')

    ->register('transport.eventdispatcher')
    ->asNewInstanceOf('Swift_Events_SimpleEventDispatcher')

    ->register('transport.replacementfactory')
    ->asSharedInstanceOf('Swift_StreamFilters_StringReplacementFilterFactory')

    ->register('address.idnaddressencoder')
    ->asNewInstanceOf('Swift_AddressEncoder_IdnAddressEncoder')

    ->register('address.utf8addressencoder')
    ->asNewInstanceOf('Swift_AddressEncoder_Utf8AddressEncoder')
;
