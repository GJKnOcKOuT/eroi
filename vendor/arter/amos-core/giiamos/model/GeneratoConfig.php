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


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace arter\amos\core\giiamos\model;

/**
 * Description of GeneratoConfig
 *
 * @author lisa.pelati
 */
class GeneratoConfig {

    /**
     * 
     * @return array
     * Configuration array: 
     * - baseClassNames: possible classes the base model can extend
     * - baseInterfaceNames: possible interfaces that can implement the extended model
     * - for each case class (baseclassNames), the array with the respective interfaces implemented
     *
     * how to fill :
     *  [
     *      'baseClassNames' => [
     *              '<class name>' => '<fully qualified class name>',
     *              '...'
     *      ],
     *      'baseInterfaceNames' => [
     *             '<interface name>' => '<fully qualified interface name>',
     *              '...'
     *      ]
     *      '<baseclass name>' => [
     *              '<interface name>' => '<fully qualified interface name>',
     *              '...'
     *      ]
     *  ]
     */
    public static function getDefinition() {
        return [
            'baseClassNames' => [
                'ContentModel' => 'arter\amos\core\record\ContentModel',
                'Record' => 'arter\amos\core\record\Record',
                'NotifyRecord' => 'arter\amos\notificationmanager\record\NotifyRecord'
            ],
            'baseInterfaceNames' => [
                'CommentInterface' => 'arter\amos\comments\models\CommentInterface',
                'ContentModelInterface' => 'arter\amos\core\interfaces\ContentModelInterface',
                'ModelImageInterface' => 'arter\amos\core\interfaces\ModelImageInterface',
                'ViewModelInterface' => 'arter\amos\core\interfaces\ViewModelInterface',
                'SeoModelInterface' => 'arter\amos\seo\interfaces\SeoModelInterface',
                'NotifyRecordInterface' => 'arter\amos\notificationmanager\record\NotifyRecordInterface',
                'StatsToolbarInterface' => 'arter\amos\core\interfaces\StatsToolbarInterface',
                'ContentModelSearchInterface' => 'arter\amos\core\interfaces\ContentModelSearchInterface',
                'SearchModelInterface' => 'arter\amos\core\interfaces\SearchModelInterface',
            ],
            'ContentModel' => [
                'ContentModelInterface' => 'arter\amos\core\interfaces\ContentModelInterface',
                'ViewModelInterface' => 'arter\amos\core\interfaces\ViewModelInterface',
                'ContentModelSearchInterface' => 'arter\amos\core\interfaces\ContentModelSearchInterface',
                'ModelImageInterface' => 'arter\amos\core\interfaces\ModelImageInterface',
                'SearchModelInterface' => 'arter\amos\core\interfaces\SearchModelInterface',
            ],
            'Record' => [
                'StatsToolbarInterface' => 'arter\amos\core\interfaces\StatsToolbarInterface',
            ],
            'NotifyRecord' => [
                'NotifyRecordInterface' => 'arter\amos\notificationmanager\record\NotifyRecordInterface',
            ],
        ];
    }

}
