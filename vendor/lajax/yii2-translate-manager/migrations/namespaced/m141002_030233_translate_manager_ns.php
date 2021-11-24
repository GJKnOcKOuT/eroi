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


namespace lajax\translatemanager\migrations\namespaced;

require_once dirname(__DIR__) . '/m141002_030233_translate_manager.php';

/**
 * Migration to support namespaced migrations.
 *
 * This migration can be used instead of the one with global namespace.
 *
 * @see https://github.com/yiisoft/yii2/blob/2.0.10/framework/console/controllers/BaseMigrateController.php#L60
 *
 * @author moltam
 */
class m141002_030233_translate_manager_ns extends \m141002_030233_translate_manager
{
}
