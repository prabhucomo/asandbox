<?php
/**
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * @package    apostrophePlugin
 * @subpackage    model
 * @author     P'unk Avenue <apostrophe@punkave.com>
 */
abstract class PluginaButtonSlot extends BaseaButtonSlot
{
  protected $editDefault = true;
  // We don't need refreshSlot anymore thanks to ON DELETE CASCADE
  // and the new simplified non-API-driven setup

  public function getText() {
    $values = $this->getArrayValue();
    $results = array();
    if (isset($values['title']))
    {
      $results[] = $values['title'];
    }
    if (isset($values['description']))
    {
      $value = preg_replace("/(<p>|<br.*?>|<blockquote>|<li>|<dt>|<dd>|<nl>|<ol>)/i", "$1\n", $values['description']);
      
      $results[] = aHtml::toPlaintext($value);
    }
    return implode("\n", $results);
  }


public function getSearchText()
  {
    return $this->getText();
  }

}