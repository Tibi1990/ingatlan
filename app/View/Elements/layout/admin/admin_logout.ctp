<?php
	echo $this->Html->link(__( "Kijelentkezés" ), array(
		'controller' => 'users',
		'action' => 'logout',
		'admin' => true
	),
	null,
	__( 'Biztosan ki akkarsz jelentkezni?' )
	 );
?>