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
   	$this->form = new sfForm();
	  $this->form->setWidgets( array(
		 'typ' => new sfWidgetFormChoice(array('choices' => array('Kunden', 'Filialen', 'Mitarbeiter', 'Artikel','Feiertage'),'label'=>'Improttyp',)),
	    'file'    => new sfWidgetFormInputFile(array('label'=>'Datei')),
	  ));
	
	 $this->form->setValidators(array(
	'input' => new sfValidatorFile(array(
	      'required'   => true,
	      'path'       => sfConfig::get('sf_upload_dir').'/import',
	      'mime_types' => 'text',
	    ))
	));
		
  }
  
  public function executeOrder(sfWebRequest $request)
  {
   	$this->forward404Unless($request->isMethod(sfRequest::POST));
	
	//$this->importfiles = $request->getFiles();
    foreach ($request->getFiles() as $fileName) {

	            $fileSize = $fileName['size'];
	            $fileType = $fileName['type'];
	            $theFileName = $fileName['name'];
	            $uploadDir = sfConfig::get("sf_upload_dir");
	            $import_uploads = $uploadDir.'/import';

	            if(!is_dir($import_uploads))
	                mkdir($import_uploads, 0777);            

	            move_uploaded_file($fileName['tmp_name'], "$import_uploads/$theFileName");

	        }
	$this->filename = 	"$import_uploads/$theFileName"	;
	$this->typ = $request->getParameter('typ');

	$file = fopen($this->filename,'r');
		$input = explode(";",fgets($file,1000));
		$ci = count($input);
		for ($i=0; $i < $ci ; $i++) { 
			
			$input[$i] = str_replace('"','',$input[$i]);
			if(strlen($input[$i]) < 2) unset($input[$i]);
			}
	fclose($file);
	
	$this->form = new sfForm();
	
	switch($this->typ){
		case 0: //Kunden
			//$input[] = 'NICHT VORHANDEN';
			$input = array_pad($input, 12, '<empty>');
			$this->form->setWidgets( array(
			'contact' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Ansprechpartner',
				'default'=>array_search('Ansprechpartner', $input),)),
			'fon' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Telefonnummer',
				'default'=>array_search('Tel', $input),)),
			'fax' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Fax',
				'default'=>array_search('Fax', $input),)),
			'company' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Firmenname',
				'default'=>array_search('Kunde', $input),)),
			'number' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Kundennummer',
				'default'=>array_search('Kndnr', $input),)),
			'street' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Straße',
				'default'=>array_search('Strasse', $input),
				)),
			'postcode' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'PLZ',
				'default'=>array_search('PLZ', $input),)),
			'city' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Stadt',
				'default'=>array_search('Ort', $input),)),
			'contry' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Land',
				'default'=>array_search('Land', $input),)),
			'destrict' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Bezirk',
				'default'=>array_search('Bezirk', $input),)),
			'info' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Informationen',
				'default'=>array_search('Info', $input),)),
			'url' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Homepage',
				'default'=>array_search('URL', $input),)),	
			  ));
			
			break;
		case 1: //Filialen
			$input = array_pad($input, 10, '<empty>');
			$this->form->setWidgets( array(
			'number' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Filialnummer',
				'default'=>array_search('Filialnummer', $input),)),
			'contact' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Ansprechpartner',
				'default'=>array_search('Kontakt', $input),)),
			'fax' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Fax',
				'default'=>array_search('Fax', $input),)),
			'fon' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Telefonnummer',
				'default'=>array_search('Telefon', $input),)),
			'street' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Straße',
				'default'=>array_search('Straße', $input),
				)),
			'postcode' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'PLZ',
				'default'=>array_search('PLZ', $input),)),
			'city' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Stadt',
				'default'=>array_search('Ort', $input),)),
			'contry' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Land',
				'default'=>array_search('Land', $input),)),
			'destrict' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Bezirk',
				'default'=>array_search('Bezirk', $input),)),
			'info' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Informationen',
				'default'=>array_search('Info', $input),)),
			'kndnr' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Kundennummer',
				'default'=>array_search('Kndnr', $input),)),
			  ));
			
			break;
		case 2: // Mitarbeiter
			$input = array_pad($input, 12, '<empty>');
			$this->form->setWidgets( array(
			'first_name' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Vorname',
				'default'=>array_search('Vorname', $input),)),
			'last_name' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Nachname',
				'default'=>array_search('Nachname', $input),)),
			'loginname' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Login',
				'default'=>array_search('Login', $input),)),
			'email' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Email',
				'default'=>array_search('Email', $input),)),
			'group' => new sfWidgetFormChoice(array(
				'choices' => $input,
				'label'=>'Berechtigung',
				'default'=>array_search('Berechtigung', $input),)),
			
			  ));
			break;
		case 3: // Artikel
				$input = array_pad($input, 5, '<empty>');
				$this->form->setWidgets( array(
				'name' => new sfWidgetFormChoice(array(
					'choices' => $input,
					'label'=>'Artikelname',
					'default'=>array_search('artikel', $input),)),
				'matchcode' => new sfWidgetFormChoice(array(
					'choices' => $input,
					'label'=>'Matchcode',
					'default'=>array_search('Matchcode', $input),)),
				'unit' => new sfWidgetFormChoice(array(
					'choices' => $input,
					'label'=>'Einheit',
					'default'=>array_search('Einheit', $input),)),
				'description' => new sfWidgetFormChoice(array(
					'choices' => $input,
					'label'=>'Beschreibung',
					'default'=>array_search('beschreibung', $input),)),
				  ));

			break;
		case 4: // Feiertage
				$input = array_pad($input, 3, '<empty>');
				$this->form->setWidgets( array(
					'name' => new sfWidgetFormChoice(array(
						'choices' => $input,
						'label'=>'Name',
						'default'=>array_search('Feiertag', $input),)),
					'date' => new sfWidgetFormChoice(array(
						'choices' => $input,
						'label'=>'Datum',
						'default'=>array_search('Datum', $input),)),
					
					  ));

				break;	
		
	}
	$this->getUser()->setFlash('import_typ',$this->typ);
	$this->getUser()->setFlash('import_file',$this->filename);

 }

 public function executeImport(sfWebRequest $request)
  {

	$this->forward404Unless($request->isMethod(sfRequest::POST));
   	$this->return = array();
	if($this->getUser()->hasFlash('import_typ')) {
		$this->typ = $this->getUser()->getFlash('import_typ');
		
	}
	if($this->getUser()->hasFlash('import_file')) {
		$this->filename = $this->getUser()->getFlash('import_file');
	}
	
	//$request->getPostParameter($name, $default = null)
	$file = fopen($this->filename,'r');	
	$this->count = 0;
	switch($this->typ){
		case 0: //Kunden
			
			$contact = $request->getPostParameter('contact');
			$fon = $request->getPostParameter('fon');
			$fax = $request->getPostParameter('fax');
			$company = $request->getPostParameter('company');
			$number = $request->getPostParameter('number');
			$street = $request->getPostParameter('street');
			$postcode = $request->getPostParameter('postcode');
			$contry = $request->getPostParameter('contry');
			$destrict = $request->getPostParameter('destrict');
			$info = $request->getPostParameter('info');
			$city  = $request->getPostParameter('city');
			$url  = $request->getPostParameter('url');
		
			while(!feof($file)) {
				if($row = explode(";",fgets($file,4096)))
					{
					$ci = count($row);
					for ($i=0; $i < $ci ; $i++) { 
						$row[$i] = str_replace('"','',$row[$i]);
					}
					if(count($row) > 2 and is_numeric($row[$number]) and !is_numeric($row[$company]))
					{	
						$customer = new Customer();
						$customer->setNumber($row[$number]);
						$customer->setCompany($row[$company]);
						//$customer->setLogo();
						if(isset($url)) $customer->setUrl($row[$url]);
						
						$store = new Store();
						$store->setNumber(0);
						$store->setStreet($row[$street]);
						$store->setContact($row[$contact]);	
						if(isset($city)) $store->setCity($row[$city]);     
						if(isset($destrinct)) $store->setDestrict($row[$district]);
						$store->setFon($row[$fon]);   
						if(isset($fax)) $store->setFax($row[$fax]);
						$store->setPostcode($row[$postcode]);
						if(isset($info)) $store->setInfo($row[$info]);
						//$store->setCustomer($customer);
						$store->save();
						$customer->setHeadoffice($store->getID()) ;
						$customer->save();
						$store->setCustomer($customer);
						$store->save();
						
						$this->return[] = '<tr>
							<td>'.$row[$number].'</td>
							<td>'.$row[$company].'</td>
							<td>'.$row[$contact].'</td>
							<td>'.$row[$postcode].'</td>
							<td>'.$row[$street].'</td>
							</tr>';
						$this->count += 1;
						}
						
					}		
			}
		
		
			break;
		case 1: //Filialen
			$kndnr =  $request->getPostParameter('kndnr');
			$fon = $request->getPostParameter('fon');
			$contact = $request->getPostParameter('contact');
			$fon = $request->getPostParameter('fon');
			$fax = $request->getPostParameter('fax');
			$number = $request->getPostParameter('number');
			$street = $request->getPostParameter('street');
			$postcode = $request->getPostParameter('postcode');
			$contry = $request->getPostParameter('contry');
			$destrict = $request->getPostParameter('destrict');
			$info = $request->getPostParameter('info');
			$city  = $request->getPostParameter('city');
		
			while(!feof($file)) {
				if($row = explode(";",fgets($file,4096)))
					{
					$ci = count($row);
					for ($i=0; $i < $ci ; $i++) { 
						$row[$i] = str_replace('"','',$row[$i]);
							$this->count += 1;
					}
					// 
					if( count($row) > 2 and is_numeric($row[$number]) and is_numeric($row[$kndnr]))
					{	
					
						$store = new Store();
						$store->setNumber($row[$number]);
						$store->setStreet($row[$street]);
						if(isset($contact)) $store->setContact($row[$contact]);	
						if(isset($city)) $store->setCity($row[$city]);     
						if(isset($destrinct)) $store->setDestrict($row[$district]);
						$store->setFon($row[$fon]);   
						if(isset($fax)) $store->setFax($row[$fax]);
						$store->setPostcode($row[$postcode]);
						if(isset($info)) $store->setInfo($row[$info]);
						$q = Doctrine_Core::getTable('Customer')
						  ->createQuery('c')
						  ->where('c.number = ?', $row[$kndnr]);
						$customer = $q->execute();
						$store->setCustomerID( $customer[0]->getId());
						$store->save();
						$this->return[] = '<tr>
							<td>'.$row[$number].'</td>
							<td>'.$row[$contact].'</td>
							<td>'.$row[$postcode].'</td>
							<td>'.$row[$street].'</td>
							<td>'.$row[$city].'</td>
							</tr>';
								$this->count += 1;
						}
					
					}		
			}
		
			break;
		case 2: // Mitarbeiter
				$fistname =  $request->getPostParameter('first_name');
				$lastname = $request->getPostParameter('last_name');
				$email = $request->getPostParameter('email');
				$loginname = $request->getPostParameter('loginname');
				$group = $request->getPostParameter('group');
				
				while(!feof($file)) {
					if($row = explode(";",fgets($file,4096)))
						{
						$ci = count($row);
						for ($i=0; $i < $ci ; $i++) { 
							$row[$i] = str_replace('"','',$row[$i]);
						}
						if(count($row) > 2 and $row[$fistname] != 'Vorname')
						{	
							$user = new sfGuardUser();
							$user->setFirstName($row[$fistname]);
							$user->setLastName($row[$lastname]);
							$user->setUsername($row[$loginname]);
							$user->setEmailAddress($row[$email]);
							$user->setPassword($row[$loginname]);
							$user->addGroupByName(strtolower($row[$group]));

							$this->return[] = '<tr>
								<td>'.$row[$fistname].'</td>
								<td>'.$row[$lastname].'</td>
								<td>'.$row[$email].'</td>
								<td>'.$row[$loginname].'</td>
								<td>'.$row[$group].'</td>
								</tr>';
								$this->count += 1;
							}

						}		
				}
			
			
			break;
			case 3: // Artikel
					$name =  $request->getPostParameter('name');
					$matchcode = $request->getPostParameter('matchcode');
					$unit = $request->getPostParameter('unit');
					$description = $request->getPostParameter('description');
					$count = 0;

					while(!feof($file)) {
						if($row = explode(";",fgets($file,4096)))
							{
							$ci = count($row);
							for ($i=0; $i < $ci ; $i++) { 
								$row[$i] = str_replace('"','',$row[$i]);
							}
							if(count($row) > 2 and !is_numeric($row[$name] and $count = 0))
							{	
								$item = new item();
								$item->setCode($row[$matchcode]);
								$item->setName($row[$name]);
								$item->setDescription($row[$description]);
								$item->setUnit($row[$unit]);
								$item->save();
								
								}
							$this->count += 1;
							}		
					}
					$this->return[] = " ";

				break;
					case 4: // Feiertage
							$name =  $request->getPostParameter('name');
							$date = $request->getPostParameter('date');
							$this->count = 0;

							while(!feof($file)) {
								if($row = explode(";",fgets($file,4096)))
									{
									$ci = count($row);
									for ($i=0; $i < $ci ; $i++) { 
										$row[$i] = str_replace('"','',$row[$i]);
									}
									if(count($row) >= 2 and !is_numeric($row[$name] AND $this->count != 0))
									{	
										$h = new holiday();
										$tmp = strtotime($row[$date]);
										$h->setDate(date("Ymd",$tmp));
										$h->setName($row[$name]);
										$h->save();
										$this->return[] = '<tr>
												<td>'.date("m/d/Y",$tmp).'</td>
												<td>'.$row[$name].'</td>
												</tr>';
										}
									$this->count += 1;
									}		
							}
							$this->return[] = " ";

						break;
		
	}
	
	
	
	//$input = explode(";",fgets($file,1000));
	
	fclose($file);
	$this->setLayout(false);
		
  }	
}
