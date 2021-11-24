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

/**
 * Deletes an existing Language model.
 *
 * @author Lajos Molnár <lajax.m@gmail.com>
 *
 * @since 1.3
 */
class DeleteAction extends \yii\base\Action
{
    /**
     * Deletes an existing Language model.
     * If deletion is successful, the browser will be redirected to the 'list' page.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function run($id)
    {
        $this->controller->findModel($id)->delete();

        return $this->controller->redirect(['list']);
    }
}
