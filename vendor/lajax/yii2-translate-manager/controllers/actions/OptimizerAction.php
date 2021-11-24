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


namespace lajax\translatemanager\controllers\actions;

use lajax\translatemanager\services\Optimizer;

/**
 * Class for optimizing language database.
 *
 * @author Lajos Molnár <lajax.m@gmail.com>
 *
 * @since 1.0
 */
class OptimizerAction extends \yii\base\Action
{
    /**
     * Removing unused language elements.
     *
     * @return string
     */
    public function run()
    {
        $optimizer = new Optimizer();
        $optimizer->run();

        $removedLanguageElements = $optimizer->getRemovedLanguageElements();

        return $this->controller->render('optimizer', [
            'newDataProvider' => $this->controller->createLanguageSourceDataProvider($removedLanguageElements),
        ]);
    }
}
