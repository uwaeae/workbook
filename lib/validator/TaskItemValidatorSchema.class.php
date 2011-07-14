<?php
class TaskItemValidatorSchema extends sfValidatorSchema

{
  protected function configure($options = array(), $messages = array())
  {
    $this->addMessage('matchcode', 'Eine Dateibezeichung wird benötigt');
    $this->addMessage('description', 'Eine Datei wird benötigt');
  }
 
  protected function doClean($values)
  {
    $errorSchema = new sfValidatorErrorSchema($this);
   	 // echo var_dump($values );
 	
	 if (!$values['file']  && $values["name"] )
      {
        $errorSchema->addError(new sfValidatorError($this, 'required'), 'name');
      }

	if ($values['file'] && !$values["name"] )
	      {
	        $errorSchema->addError(new sfValidatorError($this, 'required'), 'file');
	      }
	if (!$values['file'] && !$values["name"] )
	      {
			unset($values);
	        //unset($values["id"]);
	      }
	if (count($errorSchema))
	    {
	     throw new sfValidatorErrorSchema($this, $errorSchema);
	    }


	if(isset($values)) return $values;
  }
}

 ?>