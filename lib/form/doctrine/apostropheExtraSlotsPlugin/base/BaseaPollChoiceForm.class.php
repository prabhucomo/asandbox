<?php

/**
 * aPollChoice form base class.
 *
 * @method aPollChoice getObject() Returns the current form's model object
 *
 * @package    asandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseaPollChoiceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'name'    => new sfWidgetFormInputText(),
      'count'   => new sfWidgetFormInputText(),
      'poll_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Poll'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'    => new sfValidatorString(array('max_length' => 255)),
      'count'   => new sfValidatorInteger(array('required' => false)),
      'poll_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Poll'))),
    ));

    $this->widgetSchema->setNameFormat('a_poll_choice[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'aPollChoice';
  }

}
