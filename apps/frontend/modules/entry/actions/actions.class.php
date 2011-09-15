<?php

/**
 * entry actions.
 *
 * @package    workbook
 * @subpackage entry
 * @author     Florian Engler
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class entryActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->entrys = Doctrine_Core::getTable('Entry')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->entry = Doctrine_Core::getTable('Entry')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->entry);
  }

  public function executeNew(sfWebRequest $request)
  {
	$this->forward404Unless($this->task = Doctrine_Core::getTable('Task')->find(array($request->getParameter('taskid'))));
	$taskid = $this->task->getId();
	$this->entrys = Doctrine_Core::getTable('Entry')->createQuery('e')
	 ->where('e.task_id ='.$taskid)
      ->execute();
	$this->getUser()->setFlash('taskid',$this->task->getId());
	$this->form = new EntryForm(NULL,array(
	'url' => $this->getController()->genUrl('entry/ajax')	
		));
	$this->form ->setDefault('task_id', $taskid);
    
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new EntryForm();

    $this->processForm($request, $this->form);

	//$this->redirect('entry/new?taskid='.$entry->getTaskId());	
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($entry = Doctrine_Core::getTable('Entry')->find(array($request->getParameter('id'))), sprintf('Object entry does not exist (%s).', $request->getParameter('id')));
    $this->form = new EntryForm($entry);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($entry = Doctrine_Core::getTable('Entry')->find(array($request->getParameter('id'))), sprintf('Object entry does not exist (%s).', $request->getParameter('id')));
    $this->form = new EntryForm($entry);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    //$request->checkCSRFProtection();

    $this->forward404Unless($entry = Doctrine_Core::getTable('Entry')->find(array($request->getParameter('id'))), sprintf('Object entry does not exist (%s).', $request->getParameter('id')));
    $entry->delete();

      $this->redirect('entry/new?taskid='.$entry->getTaskId());
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $entry = $form->save();

      $this->redirect('entry/new?taskid='.$entry->getTaskId());
    }
  }
public function executeAjax($request)
{
  $this->getResponse()->setContentType('application/json');

  $item = item::retrieveForSelect($request->getParameter('q'),$request->getParameter('limit'));

  return $this->renderText(json_encode($item));
}



}
