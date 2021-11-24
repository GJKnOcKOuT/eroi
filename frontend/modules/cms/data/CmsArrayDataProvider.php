<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */
namespace app\modules\cms\data;

use yii\data\ArrayDataProvider;
use yii\data\Pagination;


class CmsArrayDataProvider extends ArrayDataProvider
{
    private $paginator = null;

    public function getPaginator()
    {
        return $this->paginator;
    }

    public function setPaginator(Pagination $pager)
    {
        $this->paginator = $pager;
    }
}