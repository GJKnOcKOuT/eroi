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

class AnchoredDotNotation
{
    public $genres = array(
        array(
            'name'      => 'Punk',
            'subgenres' => array(
                array(
                    'name'      => 'Hardcore',
                    'subgenres' => array(
                        array(
                            'name'      => 'First wave of black metal',
                            'subgenres' => array(
                                array('name' => 'Norwegian black metal'),
                                array(
                                    'name'      => 'Death metal',
                                    'subgenres' => array(
                                        array(
                                            'name'      => 'Swedish death metal',
                                            'subgenres' => array(
                                                array('name' => 'New wave of American metal'),
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'name'      => 'Thrash metal',
                            'subgenres' => array(
                                array('name' => 'Grindcore'),
                                array(
                                    'name'      => 'Metalcore',
                                    'subgenres' => array(
                                        array('name' => 'Nu metal'),
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    );
}
