<!-- Navigation header,after login -->
<ul class="nav navbar-nav">
	<li>
		<?php echo $this->Html->link( __( 'Hirdetés feladása' ),
			array(
				'controller' => 'listings',
				'action' => 'listingAdd',
				'admin' => false 
			)); 
		?>
	</li>
	
	<li>
		<?php echo $this->Html->link( __( 'Hirdetés keresése' ),
			array(
				'controller' => 'listings',
				'action' => '#',
				'admin' => false 
			),
			array(
				'id' => 'show-search'
			)
		); 
		?>
	</li>

	<li>
		<?php echo $this->Html->link( __( 'Profilom' ),
			array(
				'controller' => 'users',
				'action' => 'userProfile',
				'admin' => false 
			)); 
		?>
	</li>
</ul>