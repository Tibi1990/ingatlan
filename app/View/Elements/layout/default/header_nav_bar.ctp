<ul class="nav navbar-nav">
	<li>
		<?php echo $this->Html->link( __( 'Regisztráció' ),
			array(
				'controller' => 'users',
				'action' => 'registration',
				'admin' => false 
			)); 
		?> 	   
	</li>

	<li>
		<?php echo $this->Html->link( __( 'Bejelentkezés' ),
			array(
				'controller' => 'users',
				'action' => 'login',
				'admin' => false 
			)); 
		?> 	   
	</li>
	
	<li>
		<?php echo $this->Html->link( __( 'Bemutatkozás' ),
			array(
				'controller' => 'pages',
				'action' => 'about',
				'admin' => false 
			)); 
		?> 	   
	</li>

	<li>
		<?php echo $this->Html->link( __( 'Kapcsolat' ),
			array(
				'controller' => 'connections',
				'action' => 'index',
				'admin' => false 
			)); 
		?> 	   
	</li>
</ul>