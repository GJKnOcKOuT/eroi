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

use Yii;
use yii\base\Exception;

/**
 * WorkflowValidationException represents an exception related to workflow validation performed
 * by Workflow Source component and related PHP array Parsers.
 * 
 * @see \raoul2000\workflow\source\file\WorkflowFileSource
 *
 */
class WorkflowValidationException extends Exception
{
	/**
	 * @return string the user-friendly name of this exception
	 */
	public function getName()
	{
		return 'Workflow Validation Exception';
	}
}
