<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\core\interfaces
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\interfaces;

/**
 * Interface ContentModelInterface
 *
 * Must be implemented by those model that provides contents to share/publish such as
 * News, Discussioni, Documenti, ..
 *
 * @package arter\amos\core\record
 */
interface ContentModelInterface extends BaseContentModelInterface, WorkflowModelInterface, ModelLabelsInterface
{
    /**
     * @return array The columns ti show as default in GridViewWidget
     */
    public function getGridViewColumns();

    /**
     * @return DateTime date begin of publication
     */
    public function getPublicatedFrom();

    /**
     * @return DateTime date end of publication
     */
    public function getPublicatedAt();

    /**
     * @return \yii\db\ActiveQuery category of content
     */
    public function getCategory();

    /**
     * @return string The classname of the generic dashboard widget to access the plugin
     */
    public function getPluginWidgetClassname();
}
