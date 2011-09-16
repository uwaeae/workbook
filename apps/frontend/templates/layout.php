<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php $calendar = $sf_user->getAttribute('calendar') ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<?php include_http_metas() ?>
		<?php include_metas() ?>
		<?php include_title() ?>
		<link rel="shortcut icon" href="/favicon.ico" />
		<?php include_stylesheets() ?>
		<?php include_javascripts() ?>
	</head>
	<body>
	<div class="header">
		<h1>WORKBOOK</h1>
		<?php if ($sf_user->isAuthenticated()): ?>
		<?php echo $sf_user  ?> 	
		<div class="usermenu">
				<ul>
				<?php if ($sf_user->hasPermission('admin')): ?>
					<li><?php echo link_to('Admin', '/backend.php') ; ?></li>
				<?php endif ?>
					<li><?php echo link_to('Logout','sfGuardAuth/signout'); ?></li>
					<li>
					<?php echo link_to('Einstellungen','user/edit/?id='.$sf_user->getId()); ?></li>
				</ul>
		</div>
		<?php endif ?>
	</div>
	<?php if ($sf_user->isAuthenticated()): ?>
	<div class="menu">
		<ul>
			<li><?php echo link_to('Kalender','calendar/table/?next='.($calendar['next'])); ?></li>
			<li><?php echo link_to('Auftäge','job'); ?></li>
		<?php if ($sf_user->hasPermission('Neu')): ?>
			<li><?php echo link_to('Neu','job/new'); ?></li>
			<!-- <li><?php echo link_to('Neu(Random)','job/random'); ?></li> -->
		<?php endif ?>	
			</li>
		<?php if ($sf_user->hasPermission('Kunden')): ?>
		    <li><?php echo link_to('Kunden','customer'); ?></li>
		<?php endif ?>
		<?php if ($sf_user->hasPermission('Kunden')): ?>	
			<li><?php echo link_to('Archiv','job/archiv'); ?></li>
		<?php endif ?>	
			<li><?php echo link_to('Stunden','payroll/index'); ?></li>
		</ul>	
	</div>
	<?php endif ?>
	
	<div class="content">
    <?php echo $sf_content ?>
	</div>
	<div class="permissions">
<!--	<table border="0" cellspacing="5" cellpadding="5">
		<tr><th>Berechtigung</th></tr>
		<?php foreach ($sf_user->getAllPermissions() as  $value): ?>

		<tr><td><?php echo $value ?></td></tr>
	<?php endforeach ?>
	</table> -->
	</div>
  </body>

</html>
