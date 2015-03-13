<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWidgetFormJQueryAutocompleter represents an autocompleter input widget rendered by JQuery.
 *
 * This widget needs JQuery to work.
 *
 * You also need to include the JavaScripts and stylesheets files returned by the getJavaScripts()
 * and getStylesheets() methods.
 *
 * If you use symfony 1.2, it can be done automatically for you.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfWidgetFormJQueryAutocompleter.class.php 15839 2009-02-27 05:40:57Z fabien $
 */
class sfWidgetFormJQueryAutocompleter extends sfWidgetFormInput
{
  /**
   * Configures the current widget.
   *
   * Available options:
   *
   *  * url:            The URL to call to get the choices to use (required)
   *  * config:         A JavaScript array that configures the JQuery autocompleter widget
   *  * value_callback: A callback that converts the value before it is displayed
   *
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    $this->addRequiredOption('url');
    $this->addOption('value_callback');
    $this->addOption('config', '{ }');

    // this is required as it can be used as a renderer class for sfWidgetFormChoice
    $this->addOption('choices');

    parent::configure($options, $attributes);
  }

  /**
   * @param  string $name        The element name
   * @param  string $value       The date displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $visibleValue = $this->getOption('value_callback') ? call_user_func($this->getOption('value_callback'), $value) : $value;

    return $this->renderTag('input', array('type' => 'hidden', 'name' => $name, 'value' => $value)).
           parent::render('autocomplete_'.$name, $visibleValue, $attributes, $errors).
           sprintf(
			   <<<EOF
	<script type="text/javascript">
		 $(document).ready(function() {

			$( "#%s" ).autocomplete({
				source: function( request, response ) {
					$.ajax({
						url: "%s",
						dataType: "json",
						data: {
						q: request.term
						},
						success: function( data ) {
							console.log(data);
							var result = $.map( data, function( value, key ) {
  									return {id:key,value:value};
								});
							response( result);
						}
			   		});
				},
				minLength: 2,
				select: function( event, data ) {

					console.log(data);
					$("#%s").val(data.item.id);
				},
				 open: function() {
$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
},
close: function() {
$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
}
			});
		});







</script>
EOF
      ,
      $this->generateId('autocomplete_'.$name),
      $this->getOption('url'),
      //$this->getOption('config'),
      $this->generateId($name)
    );
  }


/*

  		  jQuery(document).ready(function() {
    		jQuery()
    		.autocomplete({
				source: function( request, response ) {
					$.ajax({
					url: "",
				   dataType: "jsonp",
					data: {
					q: request.term
					},
					success: function( data ) {
						response( data );
						}
					});
				},
				minLength: 3,
				select: function( event, ui ) {
					log( ui.item ?
					"Selected: " + ui.item.label :
					"Nothing selected, input was " + this.value);
				}

  			});



    .autocomplete('', jQuery.extend({}, {
      dataType: 'json',
      parse:    function(data) {
        var parsed = [];
        for (key in data) {
          parsed[parsed.length] = { data: [ data[key], key ], value: data[key], result: data[key] };
        }
        return parsed;
      }
    },
    ))
    .result(function(event, data) { jQuery("#%s").val(data[1]); });

    */


  /**
   * Gets the stylesheet paths associated with the widget.
   *
   * @return array An array of stylesheet paths
   */
  public function getStylesheets()
  {
    return array('/sfFormExtraPlugin/css/jquery.autocompleter.css' => 'all');
  }

  /**
   * Gets the JavaScript paths associated with the widget.
   *
   * @return array An array of JavaScript paths
   */
  public function getJavascripts()
  {
    return null;//array('/sfFormExtraPlugin/js/jquery.autocompleter.js');
  }
}
