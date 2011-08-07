<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
	


  </head>
  <body>
	<div class="header">
		<h1>WORKBOOK Administration</h1>
			<?php if ($sf_user->isAuthenticated()): ?>
			<?php echo $sf_user  ?> 	
			<div class="usermenu">
					<ul>
					
						<li><a href="/">zurück</a></li>
				
					
					</ul>
			</div>
			<?php endif ?>
	</div>
	<?php if ($sf_user->isAuthenticated()): ?>
	<div class="menu">
		<ul>
			<li><div id='#box'>
				Aufträge
				<ul id="#entry">
				<li><?php echo link_to('Auftäge','job'); ?></li>
				<li><?php echo link_to('Auftrags Typen','jobtype'); ?></li>
				<li><?php echo link_to('Auftrags Status','job_state'); ?></li>
				<ul>
				</div>	
			</li>
			<li><div id='#box'>
				Arbeit
				<ul id="#entry">
				<li><?php echo link_to('Arbeit','task'); ?></li>
				<li><?php echo link_to('Arbeit Type','task_type'); ?></li>
				<ul>
				</div>	
			</li>
			<li><div id='#box'>
				Material
				<ul id="#entry">
				<li><?php echo link_to('Artikel','item'); ?></li>
				<li><?php echo link_to('Type','item_typ'); ?></li>
				<ul>
				</div>	
			</li>
			<li><?php echo link_to('Kunden','customer'); ?></li>
		
			<li><?php echo link_to('Rechnung','invoice'); ?></li>
		
			<li><div id='#box'>
				Mitarbeiter
				<ul id="#entry">
				<li><a href="<?php echo url_for('guard/users'); ?>">Mitarbeiter</a></li>
				<li><a href="<?php echo url_for('guard/groups'); ?>">Gruppen</a></li>
				<li><a href="<?php echo url_for('guard/permissions'); ?>">Berechtigung</a></li>
				<ul>
				</div>	
			</li>	
			<li><div>
				Optionen
				<ul>
				<!-- <li><a href="<?php echo url_for('job_state'); ?>">Status</a></li> -->
				<li><a href="<?php echo url_for('file'); ?>">Dateien</a></li>
				<li><a href="<?php echo url_for('import/index'); ?>">Import</a></li>
				<!--<li><a href="<?php //echo url_for('guard/permissions'); ?>">Export</a></li>-->
				<ul>
				</div>	
			</li>	
		</ul>	
	</div>
	<?php endif ?>
	<div class="content">
    <?php echo $sf_content ?>
	</div>
  </body>
</html>
