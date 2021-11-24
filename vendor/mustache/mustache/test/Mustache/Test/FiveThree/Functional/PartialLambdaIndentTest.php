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
 * This file is part of Mustache.php.
 *
 * (c) 2010-2017 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @group lambdas
 * @group functional
 */
class Mustache_Test_FiveThree_Functional_PartialLambdaIndentTest extends PHPUnit_Framework_TestCase
{
    public function testLambdasInsidePartialsAreIndentedProperly()
    {
        $src = <<<'EOS'
<fieldset>
  {{> input }}
</fieldset>

EOS;
        $partial = <<<'EOS'
<input placeholder="{{# _t }}Enter your name{{/ _t }}">

EOS;

        $expected = <<<'EOS'
<fieldset>
  <input placeholder="ENTER YOUR NAME">
</fieldset>

EOS;

        $m = new Mustache_Engine(array(
            'partials' => array('input' => $partial),
        ));

        $tpl = $m->loadTemplate($src);

        $data = new Mustache_Test_FiveThree_Functional_ClassWithLambda();
        $this->assertEquals($expected, $tpl->render($data));
    }

    public function testLambdaInterpolationsInsidePartialsAreIndentedProperly()
    {
        $src = <<<'EOS'
<fieldset>
  {{> input }}
</fieldset>

EOS;
        $partial = <<<'EOS'
<input placeholder="{{ placeholder }}">

EOS;

        $expected = <<<'EOS'
<fieldset>
  <input placeholder="Enter your name">
</fieldset>

EOS;

        $m = new Mustache_Engine(array(
            'partials' => array('input' => $partial),
        ));

        $tpl = $m->loadTemplate($src);

        $data = new Mustache_Test_FiveThree_Functional_ClassWithLambda();
        $this->assertEquals($expected, $tpl->render($data));
    }
}

class Mustache_Test_FiveThree_Functional_ClassWithLambda
{
    public function _t()
    {
        return function ($val) {
            return strtoupper($val);
        };
    }

    public function placeholder()
    {
        return function () {
            return 'Enter your name';
        };
    }
}
