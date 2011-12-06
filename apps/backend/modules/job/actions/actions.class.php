<?php

require_once dirname(__FILE__).'/../lib/jobGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/jobGeneratorHelper.class.php';

/**
 * job actions.
 *
 * @package    workbook
 * @subpackage job
 * @author     Florian Engler
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class jobActions extends autoJobActions
{
	public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

	$job = $this->getRoute()->getObject();
	//$job->setFiles();
	foreach($job->getFiles() as $file){
		$filejob = Doctrine_Core::getTable('FileJob')->createQuery('f')
		  ->where('f.file_id ='.$file->getId())
	      ->execute();
		foreach ($filejob as $fj) {
			$fj->delete();
		}
	}
	$job->save();
	
	foreach ($job->getTasks() as $task ) {
		foreach ($task->getEntry()  as $entry) {
			$entry->delete();
		}
		$taskusers = Doctrine_Core::getTable('TaskUser')->createQuery('t')
		  ->where('t.task_id ='.$task->getId())
	      ->execute();
		foreach ($taskusers as $tu) {
			$tu->delete();
		}
		$task->delete();
	} 

	$job->save();
 

    if ($this->getRoute()->getObject()->delete())
    {
      $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    }

    $this->redirect('@job');
  }
	
}
