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

namespace raoul2000\workflow\source\file;

/**
 * This interface must be implemented by any PHP class that
 * is able to provide a workflow definition. 
 */
interface IWorkflowDefinitionProvider
{
	/**
	 * Returns the workflow definition in the form of an array.
	 * @return array
	 */
	public function getDefinition();
}
