<?php

/*

Copyright (c) 2011 Brent Shaffer 

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is furnished
to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
  
 */

/**
 * Manager for exporting doctrine models.
 *
 * @package    sfHadoriThemePlugin
 * @subpackage export
 * @author     Brent Shaffer <bshafs@gmail.com>
 * 
 * 
 */
class sfExportManager
{
  protected
    $options            = array(),
    $error              = null,
    $response           = null,
    $_data              = array();

  public function __construct(sfResponse $response = null)
  {
    $this->response = $response;
  }

  public function export($collection, $fields, $title)
  {
    $this->doExport($collection, $fields, $title);

    $this->output($title);
  }

  /**
   * doExport
   *
   * default sheet export for collection
   *
   * @param array|object $collection
   * @param array $fields
   * @author Brent Shaffer
   */
  public function doExport($collection, $fields)
  {
    // Initialize coordinate counters
    $headers = array();

    $fields = $this->cleanFields($fields);

    foreach ($fields as $field => $label)
    {
      $headers[] = $this->exportHeader($field, $label);
    }
    $this->addLine($headers);

    foreach ($collection as $record)
    {
      $cells = array();
      foreach ($fields as $field => $label)
      {
        $cells[] = $this->exportField($record, $field);
      }
      $this->addLine($cells);
    }

    return $this->_data;
  }

  public function output($filename, $format = null)
  {
    if(is_null($format))
    {
      $format = $this->getDefaultFormat();
    }

    switch(strtolower($format))
    {
      case 'excel2007':
        $content_type = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
        $ext = 'xlsx';
        break;
      case 'csv':
        $content_type = 'text/csv';
        $ext = 'csv';
        break;
      case 'html':
        $content_type = 'text/html';
        $ext = 'html';
        break;
      case 'pdf':
        $content_type = 'application/pdf';
        $ext = 'pdf';
        break;
      default:
        $content_type = 'application/vnd.ms-excel';
        $ext = 'xls';
    }

    // redirect output to client browser
    if(strtolower($format) != 'html')
    {
      $this->response->setHttpHeader('Content-Type', $content_type);
      $this->response->setHttpHeader('Content-Disposition', sprintf('attachment;filename="%s.%s"', $filename, $ext));
      $this->response->setHttpHeader('Cache-Control', 'max-age=0');
    }

    $this->response->setContent(implode("\r\n", $this->_data));

    return true;
  }

  public function exportHeader($field, $label)
  {
    return $label ? $label : sfInflector::humanize($field);
  }

  public function exportField($object, $field)
  {
    return $object[$field];
  }

  public function getDefaultFormat()
  {
    return 'csv';
  }

  public function getDownloadRoute()
  {
    return null;
  }

  public function getErrorMessage()
  {
    return $this->error;
  }

  public function setErrorMessage($error)
  {
    $this->error = $error;
  }

  protected function addLine($values)
  {
    foreach ($values as &$value)
    {
      $value = utf8_decode($this->escapeString($value));
    }
    $this->_data[] = implode(',', $values);
  }

  protected function escapeString($string)
  {
    $string = str_replace('"', '""', $string);
    if (strpos($string, '"') !== false or strpos($string, ',') !== false) {
      $string = '"'.$string.'"';
    }

    return $string;
  }

  // Makes sure fields are in "Field" => "Label" format
  protected function cleanFields($fields)
  {
    foreach ($fields as $key => $value)
    {
      if (is_int($key))
      {
        $clean[$value] = null;
      }
      else
      {
        $clean[$key] = $value;
      }
    }

    foreach ($clean as $field => $label)
    {
      if (!$label)
      {
        $clean[$field] = sfInflector::humanize($field);
      }
    }

    return $clean;
  }
}