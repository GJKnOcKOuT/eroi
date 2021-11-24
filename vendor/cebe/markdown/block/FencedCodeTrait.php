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

/**
 * @copyright Copyright (c) 2014 Carsten Brandt
 * @license https://github.com/cebe/markdown/blob/master/LICENSE
 * @link https://github.com/cebe/markdown#readme
 */

namespace cebe\markdown\block;

/**
 * Adds the fenced code blocks
 *
 * automatically included 4 space indented code blocks
 */
trait FencedCodeTrait
{
	use CodeTrait;

	/**
	 * identify a line as the beginning of a fenced code block.
	 */
	protected function identifyFencedCode($line)
	{
		return ($line[0] === '`' && strncmp($line, '```', 3) === 0) ||
			   ($line[0] === '~' && strncmp($line, '~~~', 3) === 0) ||
			   (isset($line[3]) && (
					($line[3] === '`' && strncmp(ltrim($line), '```', 3) === 0) ||
					($line[3] === '~' && strncmp(ltrim($line), '~~~', 3) === 0)
			   ));
	}

	/**
	 * Consume lines for a fenced code block
	 */
	protected function consumeFencedCode($lines, $current)
	{
		$line = ltrim($lines[$current]);
		$fence = substr($line, 0, $pos = strrpos($line, $line[0]) + 1);
		$language = rtrim(substr($line, $pos));
		// consume until end fence
		$content = [];
		for ($i = $current + 1, $count = count($lines); $i < $count; $i++) {
			if (($pos = strpos($line = $lines[$i], $fence)) === false || $pos > 3) {
				$content[] = $line;
			} else {
				break;
			}
		}
		$block = [
			'code',
			'content' => implode("\n", $content),
		];
		if (!empty($language)) {
			$block['language'] = $language;
		}
		return [$block, $i];
	}
}
