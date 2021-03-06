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
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\Docs;

class StructuralElement extends \Google\Model
{
  public $endIndex;
  protected $paragraphType = Paragraph::class;
  protected $paragraphDataType = '';
  protected $sectionBreakType = SectionBreak::class;
  protected $sectionBreakDataType = '';
  public $startIndex;
  protected $tableType = Table::class;
  protected $tableDataType = '';
  protected $tableOfContentsType = TableOfContents::class;
  protected $tableOfContentsDataType = '';

  public function setEndIndex($endIndex)
  {
    $this->endIndex = $endIndex;
  }
  public function getEndIndex()
  {
    return $this->endIndex;
  }
  /**
   * @param Paragraph
   */
  public function setParagraph(Paragraph $paragraph)
  {
    $this->paragraph = $paragraph;
  }
  /**
   * @return Paragraph
   */
  public function getParagraph()
  {
    return $this->paragraph;
  }
  /**
   * @param SectionBreak
   */
  public function setSectionBreak(SectionBreak $sectionBreak)
  {
    $this->sectionBreak = $sectionBreak;
  }
  /**
   * @return SectionBreak
   */
  public function getSectionBreak()
  {
    return $this->sectionBreak;
  }
  public function setStartIndex($startIndex)
  {
    $this->startIndex = $startIndex;
  }
  public function getStartIndex()
  {
    return $this->startIndex;
  }
  /**
   * @param Table
   */
  public function setTable(Table $table)
  {
    $this->table = $table;
  }
  /**
   * @return Table
   */
  public function getTable()
  {
    return $this->table;
  }
  /**
   * @param TableOfContents
   */
  public function setTableOfContents(TableOfContents $tableOfContents)
  {
    $this->tableOfContents = $tableOfContents;
  }
  /**
   * @return TableOfContents
   */
  public function getTableOfContents()
  {
    return $this->tableOfContents;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(StructuralElement::class, 'Google_Service_Docs_StructuralElement');
