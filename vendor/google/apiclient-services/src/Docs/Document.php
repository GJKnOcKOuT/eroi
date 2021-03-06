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

class Document extends \Google\Model
{
  protected $bodyType = Body::class;
  protected $bodyDataType = '';
  public $documentId;
  protected $documentStyleType = DocumentStyle::class;
  protected $documentStyleDataType = '';
  protected $footersType = Footer::class;
  protected $footersDataType = 'map';
  protected $footnotesType = Footnote::class;
  protected $footnotesDataType = 'map';
  protected $headersType = Header::class;
  protected $headersDataType = 'map';
  protected $inlineObjectsType = InlineObject::class;
  protected $inlineObjectsDataType = 'map';
  protected $listsType = DocsList::class;
  protected $listsDataType = 'map';
  protected $namedRangesType = NamedRanges::class;
  protected $namedRangesDataType = 'map';
  protected $namedStylesType = NamedStyles::class;
  protected $namedStylesDataType = '';
  protected $positionedObjectsType = PositionedObject::class;
  protected $positionedObjectsDataType = 'map';
  public $revisionId;
  protected $suggestedDocumentStyleChangesType = SuggestedDocumentStyle::class;
  protected $suggestedDocumentStyleChangesDataType = 'map';
  protected $suggestedNamedStylesChangesType = SuggestedNamedStyles::class;
  protected $suggestedNamedStylesChangesDataType = 'map';
  public $suggestionsViewMode;
  public $title;

  /**
   * @param Body
   */
  public function setBody(Body $body)
  {
    $this->body = $body;
  }
  /**
   * @return Body
   */
  public function getBody()
  {
    return $this->body;
  }
  public function setDocumentId($documentId)
  {
    $this->documentId = $documentId;
  }
  public function getDocumentId()
  {
    return $this->documentId;
  }
  /**
   * @param DocumentStyle
   */
  public function setDocumentStyle(DocumentStyle $documentStyle)
  {
    $this->documentStyle = $documentStyle;
  }
  /**
   * @return DocumentStyle
   */
  public function getDocumentStyle()
  {
    return $this->documentStyle;
  }
  /**
   * @param Footer[]
   */
  public function setFooters($footers)
  {
    $this->footers = $footers;
  }
  /**
   * @return Footer[]
   */
  public function getFooters()
  {
    return $this->footers;
  }
  /**
   * @param Footnote[]
   */
  public function setFootnotes($footnotes)
  {
    $this->footnotes = $footnotes;
  }
  /**
   * @return Footnote[]
   */
  public function getFootnotes()
  {
    return $this->footnotes;
  }
  /**
   * @param Header[]
   */
  public function setHeaders($headers)
  {
    $this->headers = $headers;
  }
  /**
   * @return Header[]
   */
  public function getHeaders()
  {
    return $this->headers;
  }
  /**
   * @param InlineObject[]
   */
  public function setInlineObjects($inlineObjects)
  {
    $this->inlineObjects = $inlineObjects;
  }
  /**
   * @return InlineObject[]
   */
  public function getInlineObjects()
  {
    return $this->inlineObjects;
  }
  /**
   * @param DocsList[]
   */
  public function setLists($lists)
  {
    $this->lists = $lists;
  }
  /**
   * @return DocsList[]
   */
  public function getLists()
  {
    return $this->lists;
  }
  /**
   * @param NamedRanges[]
   */
  public function setNamedRanges($namedRanges)
  {
    $this->namedRanges = $namedRanges;
  }
  /**
   * @return NamedRanges[]
   */
  public function getNamedRanges()
  {
    return $this->namedRanges;
  }
  /**
   * @param NamedStyles
   */
  public function setNamedStyles(NamedStyles $namedStyles)
  {
    $this->namedStyles = $namedStyles;
  }
  /**
   * @return NamedStyles
   */
  public function getNamedStyles()
  {
    return $this->namedStyles;
  }
  /**
   * @param PositionedObject[]
   */
  public function setPositionedObjects($positionedObjects)
  {
    $this->positionedObjects = $positionedObjects;
  }
  /**
   * @return PositionedObject[]
   */
  public function getPositionedObjects()
  {
    return $this->positionedObjects;
  }
  public function setRevisionId($revisionId)
  {
    $this->revisionId = $revisionId;
  }
  public function getRevisionId()
  {
    return $this->revisionId;
  }
  /**
   * @param SuggestedDocumentStyle[]
   */
  public function setSuggestedDocumentStyleChanges($suggestedDocumentStyleChanges)
  {
    $this->suggestedDocumentStyleChanges = $suggestedDocumentStyleChanges;
  }
  /**
   * @return SuggestedDocumentStyle[]
   */
  public function getSuggestedDocumentStyleChanges()
  {
    return $this->suggestedDocumentStyleChanges;
  }
  /**
   * @param SuggestedNamedStyles[]
   */
  public function setSuggestedNamedStylesChanges($suggestedNamedStylesChanges)
  {
    $this->suggestedNamedStylesChanges = $suggestedNamedStylesChanges;
  }
  /**
   * @return SuggestedNamedStyles[]
   */
  public function getSuggestedNamedStylesChanges()
  {
    return $this->suggestedNamedStylesChanges;
  }
  public function setSuggestionsViewMode($suggestionsViewMode)
  {
    $this->suggestionsViewMode = $suggestionsViewMode;
  }
  public function getSuggestionsViewMode()
  {
    return $this->suggestionsViewMode;
  }
  public function setTitle($title)
  {
    $this->title = $title;
  }
  public function getTitle()
  {
    return $this->title;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Document::class, 'Google_Service_Docs_Document');
