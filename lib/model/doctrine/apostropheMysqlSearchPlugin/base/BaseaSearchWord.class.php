<?php

/**
 * BaseaSearchWord
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property varchar $text
 * @property Doctrine_Collection $Usages
 * 
 * @method varchar             getText()   Returns the current record's "text" value
 * @method Doctrine_Collection getUsages() Returns the current record's "Usages" collection
 * @method aSearchWord         setText()   Sets the current record's "text" value
 * @method aSearchWord         setUsages() Sets the current record's "Usages" collection
 * 
 * @package    asandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseaSearchWord extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('a_search_word');
        $this->hasColumn('text', 'varchar', 100, array(
             'type' => 'varchar',
             'notnull' => true,
             'unique' => true,
             'length' => 100,
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('aSearchUsage as Usages', array(
             'local' => 'id',
             'foreign' => 'word_id'));
    }
}