<?php

/**
 * aPoll filter form base class.
 *
 * @package    asandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseaPollFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'media_item_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MediaItem'), 'add_empty' => true)),
      'question'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'media_item_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('MediaItem'), 'column' => 'id')),
      'question'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('a_poll_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'aPoll';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'media_item_id' => 'ForeignKey',
      'question'      => 'Text',
    );
  }
}
