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
 * @group mustache_injection
 * @group functional
 */
class Mustache_Test_Functional_MustacheInjectionTest extends PHPUnit_Framework_TestCase
{
    private $mustache;

    public function setUp()
    {
        $this->mustache = new Mustache_Engine();
    }

    /**
     * @dataProvider injectionData
     */
    public function testInjection($tpl, $data, $partials, $expect)
    {
        $this->mustache->setPartials($partials);
        $this->assertEquals($expect, $this->mustache->render($tpl, $data));
    }

    public function injectionData()
    {
        $interpolationData = array(
            'a' => '{{ b }}',
            'b' => 'FAIL',
        );

        $sectionData = array(
            'a' => true,
            'b' => '{{ c }}',
            'c' => 'FAIL',
        );

        $lambdaInterpolationData = array(
            'a' => array($this, 'lambdaInterpolationCallback'),
            'b' => '{{ c }}',
            'c' => 'FAIL',
        );

        $lambdaSectionData = array(
            'a' => array($this, 'lambdaSectionCallback'),
            'b' => '{{ c }}',
            'c' => 'FAIL',
        );

        return array(
            array('{{ a }}',   $interpolationData, array(), '{{ b }}'),
            array('{{{ a }}}', $interpolationData, array(), '{{ b }}'),

            array('{{# a }}{{ b }}{{/ a }}',   $sectionData, array(), '{{ c }}'),
            array('{{# a }}{{{ b }}}{{/ a }}', $sectionData, array(), '{{ c }}'),

            array('{{> partial }}', $interpolationData, array('partial' => '{{ a }}'),   '{{ b }}'),
            array('{{> partial }}', $interpolationData, array('partial' => '{{{ a }}}'), '{{ b }}'),

            array('{{ a }}',           $lambdaInterpolationData, array(), '{{ c }}'),
            array('{{# a }}b{{/ a }}', $lambdaSectionData,       array(), '{{ c }}'),
        );
    }

    public static function lambdaInterpolationCallback()
    {
        return '{{ b }}';
    }

    public static function lambdaSectionCallback($text)
    {
        return '{{ ' . $text . ' }}';
    }
}
