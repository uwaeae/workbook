<?php

/**
 * import actions.
 *
 * @package    workbook
 * @subpackage import
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class importActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
     $this->form = new IndexForm();

  }

	public function executeShow(sfWebRequest $request)
  {
    $this->renderText('Show');
	return sfView::NONE;
  }

	public function executeList(sfWebRequest $request)
  {
    $this->renderText('List');
	return sfView::NONE;
  }
}
