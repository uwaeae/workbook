<?php

class testdataTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
     $this->addArguments(array(
       new sfCommandArgument('amount', sfCommandArgument::REQUIRED, 'Amount of new Jobs'),
     ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = '';
    $this->name             = 'testdata';
    $this->briefDescription = 'Creates an big amount of Random Jobs for the Workbook';
    $this->detailedDescription = <<<EOF
The [testdata|INFO] generates Random Data for the Workbook Project
this Task is written by Florian Engler mail@uwaeae.de

  [php symfony testdata|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

	$contact = array('Herr Müller','Herr Maier','Herr Fischer', 'Frau Einbeck', 'Frau Zwieback', 'Fräulein Klein');
	$contactinfo = array('im Buero zu Erreichen','im Lager','auf der Damen WC', 'im Bett', 'unter der Kasse', 'in der Umkleide');
	$users = array();
	for ($i=1; $i < 4 ; $i++) { 
		$users[$i] = array();
	}
	$weekend = 0;
	
	
	for ($i=1; $i < $arguments['amount']; $i++) { 
	
	$day = round(($i + $weekend)/15); 
	//rand ( 1 ,  20 );
	$month = 0;round(($i + $weekend)/(15*31)); 
	//rand ( 0 , 2 ); 
	$we = date('w',mktime(0,0,0,date("m")+$month ,date("d")+$day,date("Y")));
	if(	$we == 0 ) {$weekend ++;  $day++;}
	if( $we == 6 ){ $weekend +=2; $day += 2;}
	$user = rand(1,3);  
	$job = new Job();
	$day_z = date('z',mktime(0,0,0,date("m")+$month ,date("d")+$day,date("Y")));
	$user_end = 10;
	if(isset($users[$user][$day_z])) {
			$user_end = $users[$user][$day_z] + 2;
			
	}

	$this->logSection($i, $day_z.' Time '.date('Y-m-d',mktime(0,0,0,date("m")+$month ,date("d")+$day,date("Y"))));
	$job->setContactPerson($contact[rand(0,5)]);
	$job->setContactInfo($contactinfo[rand(0,5)]);
	$job->setJobTypeId(rand ( 1 ,  4 ))    ;

	
	$job->setEnd(date('c',mktime(0,0,0,date("m")+$month ,date("d")+$day,date("Y"))))         ;
	$job->setStart(date('c',mktime(0,0,0,date("m")+$month ,date("d") +$day -1,date("Y"))))         ;
	$job->setDescription('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.')    ;
	$job->setTimeinterval(0)  ;
	$job->setJobStateId(1)    ;
	$job-> setStoreId(rand ( 1 ,  30 ))       ;
	$job->save();
	$this->logSection($i, 'generate Job '.$job->getId());
	$task= new Task();
	$task->setJobId($job->getId());
	
	$task->setStart(date('c',mktime($user_end - rand(1,2),0,0,date("m")+$month ,date("d") +$day ,date("Y"))));      
	$task->setEnd(date('c',mktime($user_end ,0,0,date("m")+$month ,date("d") +$day ,date("Y"))));
	$task->setScheduled(true) ;
	$task->setTaskTypeId(1);
	
	$task->save();
		$this->logSection($i,'generate Task  '.$task->getId().' at '.$user_end);
	$taskuser = new TaskUser();
	$taskuser->setUserId($user);
	$taskuser->setTaskId($task->getID());
	$this->logSection($i,'Add User'.$user.' to Task '.$task->getId());
	$taskuser->save();
	
	$users[$user][$day_z] = $user_end;
	$this->logSection(' ', ' ');
	
	}	

  }
}
