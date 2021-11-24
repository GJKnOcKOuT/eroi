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


namespace PhpParser\ErrorHandler;

use PhpParser\Error;

class CollectingTest extends \PHPUnit_Framework_TestCase {
    public function testHandleError() {
        $errorHandler = new Collecting();
        $this->assertFalse($errorHandler->hasErrors());
        $this->assertEmpty($errorHandler->getErrors());

        $errorHandler->handleError($e1 = new Error('Test 1'));
        $errorHandler->handleError($e2 = new Error('Test 2'));
        $this->assertTrue($errorHandler->hasErrors());
        $this->assertSame([$e1, $e2], $errorHandler->getErrors());

        $errorHandler->clearErrors();
        $this->assertFalse($errorHandler->hasErrors());
        $this->assertEmpty($errorHandler->getErrors());
    }
}