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

namespace raoul2000\workflow\base;

/**
 * The interface for status ID converters.
 *
 * A status ID converter is dedicated to provide a conversion between status ID which are valid
 * for the SimpleWorkflow behavior, and status ID that can be stored in the configured status column
 * in the underlying table.
 *
 * @see StatusIdConverter
 *
 */
interface IStatusIdConverter
{
	/**
	 * Converts the status ID passed as argument into a status ID compatible
	 * with the simpleWorkflow.
	 * 
	 * @param mixed $statusId
	 */
	public function toSimpleWorkflow($statusId);

	/**
	 * Converts the status ID passed as argument into a value that is compatible
	 * with the owner model attribute configured to store the simpleWorkflow status ID.
	 *
	 * @param mixed $statusId
	 */
	public function toModelAttribute($statusId);
}
