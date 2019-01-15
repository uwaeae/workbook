<?php

/**
 * message actions.
 *
 * @package    workbook
 * @subpackage message
 * @author     Florian Engler
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class messageActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->messages = Doctrine_Core::getTable('Message')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new MessageForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new MessageForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($message = Doctrine_Core::getTable('Message')->find(array($request->getParameter('id'))), sprintf('Object message does not exist (%s).', $request->getParameter('id')));
    $this->form = new MessageForm($message);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($message = Doctrine_Core::getTable('Message')->find(array($request->getParameter('id'))), sprintf('Object message does not exist (%s).', $request->getParameter('id')));
    $this->form = new MessageForm($message);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($message = Doctrine_Core::getTable('Message')->find(array($request->getParameter('id'))), sprintf('Object message does not exist (%s).', $request->getParameter('id')));
    $message->delete();

    $this->redirect('/message/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $message = $form->save();

      $this->redirect('/message/edit?id='.$message->getId());
    }
  }
}
