<ul>	
	<li class="table_menu_left">
		<a class="button" 
			href="<?php echo url_for('calendar/'.$type.'/?&next='.($next - 1) )?>">
			zurück	</a>
	</li>	
	<li class="table_menu_left">			
		<a class="button" href="<?php echo url_for('calendar/month') ?>">
	 	Monat</a>
	</li>	
	<li class="table_menu_left">
		<a class="button" href="<?php echo url_for('calendar/week') ?>">
		Woche</a>
	</li>	
	<li class="table_menu_left">	
		<a class="button" href="<?php echo url_for('calendar/day') ?>">
		Tag</a>
	</li>	
	<li class="table_menu_left">	
		<a class="button" href="<?php echo url_for('calendar/'.$type) ?>">
		Heute</a>
	</li>	
	<li class="table_menu_left">		
		<a class="button"  href="<?php echo url_for('calendar/'.$type.'/?&next='.($next + 1)) ?>">
		vor	</a>
	</li>
</ul>