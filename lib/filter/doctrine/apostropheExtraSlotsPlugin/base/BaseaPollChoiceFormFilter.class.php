<?php

/**
 * aPollChoice filter form base class.
 *
 * @package    asandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseaPollChoiceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'count'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'poll_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Poll'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'    => new sfValidatorPass(array('required' => false)),
      'count'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'poll_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Poll'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('a_poll_choice_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'aPollChoice';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'name'    => 'Text',
      'count'   => 'Number',
      'poll_id' => 'ForeignKey',
    );
  }
}
