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
 * Error Handler allows errors to be logged to the audit_error table.
 */

namespace arter\amos\audit\components\base;

use arter\amos\audit\Audit;
use arter\amos\audit\models\AuditError;
use arter\amos\audit\panels\ErrorPanel;
use Exception;
use Yii;

/**
 * ErrorHandlerTrait
 * @package arter\amos\audit\components\base
 */
trait ErrorHandlerTrait
{
    /**
     * @param Exception $exception
     */
    public function logException($exception)
    {
        try {

            $isMemoryError = strncmp($exception->getMessage(), 'Allowed memory size of', 22) === 0;
            /** @var Audit $audit */
            $audit = Audit::getInstance();
            if (!$audit && !$isMemoryError) {
                // Only attempt to load the module if this isn't an out of memory error, not enough room otherwise
                $audit = \Yii::$app->getModule(Audit::findModuleIdentifier());
            }
            if (!$audit) {
                throw new \Exception('Audit module cannot be loaded');
            }

            $entry = $audit->getEntry(!$isMemoryError);
            if ($entry) {
                /** @var ErrorPanel $errorPanel */
                $errorPanel = $audit->getPanel($audit->findPanelIdentifier(ErrorPanel::className()));
                $errorPanel->log($entry->id, $exception);
                $entry->finalize();
            }

        } catch (\Exception $e) {
            // if we catch an exception here, let it slide, we don't want recursive errors killing the script
        }

        parent::logException($exception);
    }
}