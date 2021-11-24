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
 * Message translations for \kartik\password\StrengthValidator.
 *
 * It contains the localizable messages extracted from source code.
 * You may modify this file by translating the extracted messages.
 *
 * Each array element represents the translation (value) of a message (key).
 * If the value is empty, the message is considered as not translated.
 * Messages that no longer need translation will have their translations
 * enclosed between a pair of '@@' marks.
 *
 * Message string can be used with plural forms format. Check i18n section
 * of the guide for details.
 *
 * NOTE: this file must be saved in UTF-8 encoding.
 */
return [
    '{attribute} should contain at least {n, plural, one{one character} other{# characters}} ({found} found)!' =>
        '{attribute} повинен містити {n, plural, =1{хоча б один символ} one{мінімум # символ} few{мінімум # символа} many{мінімум # символів} other{мінімум # символів}} ({found} знайдено)!',
    '{attribute} should contain at most {n, plural, one{one character} other{# characters}} ({found} found)!' =>
        '{attribute} повинен містити не більш як {n, plural, one{# символа} other{# символів}} ({found} знайдено)!',
    '{attribute} should contain exactly {n, plural, one{one character} other{# characters}} ({found} found)!' =>
        '{attribute} повинен містити рівно {n, plural, one{# символ} few{# символів} many{# символів} other{# символів}} ({found} знайдено)!',
    '{attribute} cannot contain any spaces' => '{attribute} не може містити ніяких пробілів',
    '{attribute} cannot contain the username' => '{attribute} не може містити ім’я користувача',
    '{attribute} cannot contain an email address' => '{attribute} не може містити адресу електронної пошти',
    '{attribute} must be a string' => '{attribute} має бути рядком',
    '{attribute} should contain at least {n, plural, one{one lower case character} other{# lower case characters}} ({found} found)!' =>
        '{attribute} повинен містити мінімум {n, plural, one{# рядковий символ} few{# рядкових символів} many{# рядкових символів} other{# рядкових символів}} ({found} знайдено)!',
    '{attribute} should contain at least {n, plural, one{one upper case character} other{# upper case characters}} ({found} found)!' =>
        '{attribute} повинен містити мінімум {n, plural, one{# символ верхнього регістру} few{# символів верхнього регістру } many{# символів верхнього регістру} other{# символів верхнього регістру}} ({found} знайдено)!',
    '{attribute} should contain at least {n, plural, one{one numeric / digit character} other{# numeric / digit characters}} ({found} found)!' =>
            '{attribute} повинен містити мінімум {n, plural, one{# цифру} few{# цифр} many{# цифр} many{# цифр} other{# цифр}} ({found} знайдено)!',
    '{attribute} should contain at least {n, plural, one{one special character} other{# special characters}} ({found} found)!' =>
        '{attribute} повинен містити мінімум {n, plural, one{# спеціальний символ} few{# спеціальних  символів} many{# спеціальних  символів} other{# спеціальних  символів}} ({found} знайдено)!'
];
