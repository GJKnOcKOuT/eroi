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
 * @package    arter\amos\organizzazioni\models\search
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\organizzazioni\models\search;

use arter\amos\core\interfaces\SearchModelInterface;
use arter\amos\organizzazioni\models\Profilo;

/**
 * Class ProfiloSearch
 * ProfiloSearch represents the model behind the search form about `arter\amos\organizzazioni\models\Profilo`.
 * @package arter\amos\organizzazioni\models\search
 */
class ProfiloSearch extends Profilo implements SearchModelInterface
{
    public $isSearch = true;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'name',
                'partita_iva',
                'istat_code',
            ], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function searchFieldsLike()
    {
        return [
            'name',
            'partita_iva',
            'istat_code',
        ];
    }

    /**
     * @inheritdoc
     */
    public function searchFieldsGlobalSearch()
    {
        return [
            'name',
            'partita_iva',
            'istat_code',
        ];
    }
}
