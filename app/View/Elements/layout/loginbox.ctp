<!--After login drop down menu! -->
<div class="login-user-box">
	<ul>
		<li>
			<?php
				echo $this->Html->link(__(
					$this->Session->read( 'Auth.User.username' ) 
				),'#') . ' ';

				echo $this->Html->image( 'down-arrow.png', array(
					'width' => 16,
					'height' => 17
				) );
		  	?>
		  	<ul>
		  		<li>
		  			<?php
		  				echo $this->Html->link(__( 'Saját oldal' ), array(
		  					'controller' => 'listings',
		  					'action' => 'index'
	  					)); 
		  			 ?>
		  		</li>
	  		</ul>
			
			<ul>
		  		<li>
		  			<?php
	  				   echo $this->Html->link(__( 'Profil' ),
	  				   	array(
							'controller' => 'users',
							'action' => 'userProfile'
						)
					); 
		  			 ?>
		  		</li>
	  		</ul>

	  		<ul>
		  		<li>
		  			<?php
	  				   echo $this->Html->link(__( 'Kijeletnkezés' ),
	  				   	array(
							'controller' => 'users',
							'action' => 'logout'
						),
						array(
							'confirm' =>
							__( 'Biztos hogy ki akarsz jelentkezni?' )
						)
					); 
		  			 ?>
		  		</li>
	  		</ul>
	  	</li>
  	</ul>
</div>