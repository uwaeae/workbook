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


public function prepareDownload($response,$outFilename)
  { 
    $response->clearHttpHeaders();
    $response->addCacheControlHttpHeader('Cache-control','must-revalidate, post-check=0, pre-check=0');
    $response->setContentType('application/pdf',TRUE);
    //  $response->setHttpHeader('Content-Type', $contentType);
      $response->setHttpHeader('Content-Transfer-Encoding', 'binary', TRUE);
    $response->setHttpHeader('Content-Disposition','attachment; filename='.$outFilename, TRUE);
    $response->sendHttpHeaders();  
  }

public function executeGet(sfWebRequest $request)
{
	$this->forward404Unless($file = Doctrine_Core::getTable('File')->find(array($request->getParameter('id'))), sprintf('Object file does not exist (%s).', $request->getParameter('id')));
	$this->prepareDownload($this->getResponse(),$file->getName());
 // $this->getContext()->getResponse()->setContentType('application/pdf');

	$this->getContext()->getResponse()->setContent(readfile(sfConfig::get('sf_upload_dir').'/document/'.$file->getFile()));
  $this->getContext()->getResponse()->sendContent();
  return sfView::HEADER_ONLY;


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
    //$request->checkCSRFProtection();

    $this->forward404Unless($file = Doctrine_Core::getTable('File')->find(array($request->getParameter('id'))), sprintf('Object file does not exist (%s).', $request->getParameter('id')));
    //$filejob = Doctrine_Core::getTable('FileJob')->find(array($request->getParameter('id')));
    $filejobs =  Doctrine_Query::create()
          ->select('j.*')
          ->from('FileJob j')
          ->where('j.file_id = '.$request->getParameter('id'))
          ->execute();

    foreach($filejobs as $fj){
        $fj->delete();
    }

    $file->delete();

    $this->redirect('/job/'.$request->getParameter('jobid'));
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
		$file = $form->getValue('file');
		$filename = sha1($file->getOriginalName());
		$extension = $file->getExtension($file->getOriginalExtension());
		$file->save(sfConfig::get('sf_upload_dir').'/document/'.$filename.$extension);
		$upload = new file();
		$upload->setName($file->getOriginalName()) ;
		$upload->setFile($filename.$extension) ;
		$upload->save();
		$filejob = new FileJob();
		$filejob->setFileId($upload->getId());
		$filejob->setJobId($request->getParameter('job'));
		$filejob->save();
		$this->redirect('/job/'.$request->getParameter('job'));
		//$this->redirect('file/edit?id='.$upload->getId());
    }
  }
}
