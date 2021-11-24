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
 * Attachment class for attaching files to a {@link Swift_Mime_SimpleMessage}.
 *
 * @author Chris Corbyn
 */
class Swift_Attachment extends Swift_Mime_Attachment
{
    /**
     * Create a new Attachment.
     *
     * Details may be optionally provided to the constructor.
     *
     * @param string|Swift_OutputByteStream $data
     * @param string                        $filename
     * @param string                        $contentType
     */
    public function __construct($data = null, $filename = null, $contentType = null)
    {
        \call_user_func_array(
            [$this, 'Swift_Mime_Attachment::__construct'],
            Swift_DependencyContainer::getInstance()
                ->createDependenciesFor('mime.attachment')
            );

        $this->setBody($data, $contentType);
        $this->setFilename($filename);
    }

    /**
     * Create a new Attachment from a filesystem path.
     *
     * @param string $path
     * @param string $contentType optional
     *
     * @return self
     */
    public static function fromPath($path, $contentType = null)
    {
        return (new self())->setFile(
            new Swift_ByteStream_FileByteStream($path),
            $contentType
        );
    }
}
