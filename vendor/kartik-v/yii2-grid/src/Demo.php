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
 * @package   yii2-grid
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2018
 * @version   3.2.9
 */

namespace kartik\grid;

use Yii;

/**
 * Dummy demo class used for generating translation messages for the grid demo.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since  1.0
 */
class Demo
{
    /**
     * Demo messages
     */
    public function messages()
    {
        return [
            Yii::t('kvgrid', 'Add Book'),
            Yii::t('kvgrid', 'Book Listing'),
            Yii::t('kvgrid', 'Download Selected'),
            Yii::t('kvgrid', 'Library'),
            Yii::t('kvgrid', 'Reset Grid'),
            Yii::t('kvgrid', 'The page summary displays SUM for first 3 amount columns and AVG for the last.'),
            Yii::t('kvgrid', 'The table header sticks to the top in this demo as you scroll'),
            Yii::t('kvgrid', 'Resize table columns just like a spreadsheet by dragging the column edges.')
        ];
    }
}
