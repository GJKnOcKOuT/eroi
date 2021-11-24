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

namespace nizsheanez\assetConverter;

use yii\base\BaseObject;

abstract class Parser extends BaseObject
{
    /**
     * Parse a asset file.
     *
     * @param string $src source file path
     * @param string $dst destination file path
     * @param array $options parser options
     * @return mixed
     */
    abstract public function parse($src, $dst, $options);
}
