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


namespace Mimey;

/**
 * An interface for converting between MIME types and file extensions.
 */
interface MimeTypesInterface
{
	/**
	 * Get the first MIME type that matches the given file extension.
	 *
	 * @param string $extension The file extension to check.
	 *
	 * @return string|null The first matching MIME type or null if nothing matches.
	 */
	public function getMimeType($extension);

	/**
	 * Get the first file extension (without the dot) that matches the given MIME type.
	 *
	 * @param string $mime_type The MIME type to check.
	 *
	 * @return string|null The first matching extension or null if nothing matches.
	 */
	public function getExtension($mime_type);

	/**
	 * Get all MIME types that match the given extension.
	 *
	 * @param string $extension The file extension to check.
	 *
	 * @return array An array of MIME types that match the given extension; can be empty.
	 */
	public function getAllMimeTypes($extension);

	/**
	 * Get all file extensions (without the dots) that match the given MIME type.
	 *
	 * @param string $mime_type The MIME type to check.
	 *
	 * @return array An array of file extensions that match the given MIME type; can be empty.
	 */
	public function getAllExtensions($mime_type);
}
