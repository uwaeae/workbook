<?php
class sfFromDoubleWidget extends sfWidgetForm
{
 
  public function configure( $options = array(), $attributes = array() )
  {
 
    $this->addOption(  "someOption" );
 
    $this->addOption(  "someOtherOption", "default" );
  }
 
  public function getStylesheets()
  {
    return array(
        '/sfFromDoubleWidget/css/sfFromDoubleWidget.css' => ''
    );
  }
 
  public function getJavascripts()
  {
    return array(
        '/sfFromDoubleWidget/js/sfFromDoubleWidget.js'
    );
  }
 
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
 
        //load partial Helper as we want to outsource the Template
    sfContext::getInstance()->getConfiguration()->loadHelpers('Partial');
 
    $options = array(
        'someOption'           => $this->getOption('someOption'),
        'someOtherOption'  => $this->getOption('someOtherOption')
    );
 
    return  get_partial( 'sfFromDoubleWidget/sfFromDoubleWidget', $options );
  }
 
}

?>