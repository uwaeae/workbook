<?php

/**
 * user actions.
 *
 * @package    workbook
 * @subpackage user
 * @author     Florian Engler
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->sf_guard_users = Doctrine_Core::getTable('sfGuardUser')
      ->createQuery('a')
      ->execute();
  }


 

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($this->user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
    $this->form = new sfGuardUserForm($this->user);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($this->user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
    $this->form = new sfGuardUserForm($this->user);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }


  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $sf_guard_user = $form->save();

      $this->redirect('/user/edit?id='.$sf_guard_user->getId());
    }
  }
}
