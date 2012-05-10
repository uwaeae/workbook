<?php
class JobUserForm extends sfForm
{
    public function configure()
    {

        $this->setWidgets(array(
            'user' => new sfWidgetFormDoctrineChoice(array('model' => 'sfGuardUser', 'multiple' => true, )),
            'job' => new sfWidgetFormInputHidden()
        ));


        $this->setValidators(array(
        ));
        $this->widgetSchema->setLabels(array(
            'user'    => 'User',
            'job'      => 'Auftag',

        ));
    }
}

?>