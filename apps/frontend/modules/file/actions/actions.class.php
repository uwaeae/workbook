<?php

/**
 * file actions.
 *
 * @package    workbook
 * @subpackage file
 * @author     Florian Engler
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class fileActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->files = Doctrine_Core::getTable('File')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new FileForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new FileForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($file = Doctrine_Core::getTable('File')->find(array($request->getParameter('id'))), sprintf('Object file does not exist (%s).', $request->getParameter('id')));
    $this->form = new FileForm($file);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($file = Doctrine_Core::getTable('File')->find(array($request->getParameter('id'))), sprintf('Object file does not exist (%s).', $request->getParameter('id')));
    $this->form = new FileForm($file);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($file = Doctrine_Core::getTable('File')->find(array($request->getParameter('id'))), sprintf('Object file does not exist (%s).', $request->getParameter('id')));
    $file->delete();

    $this->redirect('file/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $file = $form->save();

      $this->redirect('file/edit?id='.$file->getId());
    }
  }
}
