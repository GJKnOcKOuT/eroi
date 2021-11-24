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
 * @package    arter\amos\events\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\events\widgets;

use arter\amos\core\forms\ShowUserTagsWidget;

/**
 * Class EventsShowUserTagsWidget
 * @package arter\amos\events\widgets
 */
class EventsShowUserTagsWidget extends ShowUserTagsWidget
{
    /**
     * @var array $tagSessionIds Array of tag values selected by user in publication step
     */
    private $tagSessionIds = [];

    /**
     * @inheritdoc
     */
    protected function getArrayTagsId()
    {
        $ret = [];
        if (!empty($this->tagSessionIds)) {
            foreach ($this->tagSessionIds as $rootId => $treeTagIdsStr) {
                if (!strlen($treeTagIdsStr)) {
                    continue;
                }
                
                $treeTagIds = explode(',', $treeTagIdsStr);
                foreach ($treeTagIds as $tagId) {
                    $ret[] = $tagId;
                }
            }
        }
        
        return $ret;
    }

    /**
     * @inheritdoc
     */
    protected function getAllTagsRoots()
    {
        $this->userTagList = $this->getArrayTagsId();
        $ret = [];
        if (!empty($this->tagSessionIds)) {
            foreach ($this->tagSessionIds as $rootId => $treeTagIdsStr) {
                if (!strlen($treeTagIdsStr)) {
                    continue;
                }
                
                $root = $this->getTagById($rootId);
                $ret[$rootId]['el'] = $root->nome;
                $ret[$rootId]['level'] = $root->lvl;
            }
        }
        
        return $ret;
    }

    /**
     * @return array
     */
    public function getTagSessionIds()
    {
        return $this->tagSessionIds;
    }

    /**
     * @param array $tagSessionIds
     */
    public function setTagSessionIds($tagSessionIds)
    {
        $this->tagSessionIds = $tagSessionIds;
    }
}
