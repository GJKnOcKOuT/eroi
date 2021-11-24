<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\core\interfaces
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\interfaces;

/**
 * Interface ModelDocumentInterface
 * @package arter\amos\core\interfaces
 */
interface ModelDocumentInterface
{
    /**
     * This method is the getter for the document file and returns an attachment File object.
     * @return \arter\amos\attachments\models\File
     */
    public function getDocument();

    /**
     * This method is the getter for the document url and web url.
     * @param string $size
     * @param bool $protected
     * @param string $url
     * @param bool $absolute
     * @param bool $canCache
     * @return string
     */
    public function getDocumentUrl($size = 'original', $protected = true, $url = '/img/img_default.jpg', $absolute = false, $canCache = false);

    /**
     * This method is the getter for the document image and returns an HTML ready to be rendered.
     * @param bool $onlyIconName
     * @return string
     */
    public function getDocumentImage($onlyIconName = false);
}
