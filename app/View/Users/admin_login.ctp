<div class="admin-login-form">
	<?php
		echo $this->Form->create( 'User', array(
	 		'action' => 'admin_login' 
	 	) );

		echo $this->Form->input( 'username', array(
			'label' => __( 'Felhasználonév' ),
		) );
		echo $this->Form->input( 'password', array(
			'label' => __('Jelszó'),
		) );
		
		echo $this->Form->end(__( 'Bejelentkezés' ) );
	?>
</div>