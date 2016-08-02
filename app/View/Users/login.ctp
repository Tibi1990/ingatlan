<div class="login-content">
	<div class="information-box">
		<ol>
		 	<li> <?php echo __( 'Adja fel <b>hirdetését</b> akkár díjmentesen is,a <b>hirdetésfeladás ingyenes!</b> Hirdetésfeladáshoz elsőnek <b>regisztrálni kell</b>.' ); ?> </li>
		 	<li> <?php echo __( 'Ha szeretné a <b>hirdetését kiemelni</b> a főoldalra. <b>Bejelentkezés</b> után megteheti.' ); ?> </li>
	 		<li> <?php echo __( '<b>Kezeld hirdetéseidet</b> gyorsan és egyszerűen,<b>szerkeszd</b> vagy <b>töröld</b> őket egy helyen!' ); ?> </li>
	 		<li> <?php echo __( '<b>Kezeld a kedvenc hirdetéseidet</b> gyorsan és egyszerűen<b> őket egy helyen!' ); ?> </li>
		</ol>
	</div>
	
	<div class="login-form" id="login-form">
		<legend>
			<?php
				echo __( 'Itt jelentkezhetsz be!' );
			?>
			<?php
				echo $this->Html->image('login.png', array(
					'height' => '40px',
					'width' => '60px',
					'alt' => __('Login'),
				) ); 
			?>
		</legend>

		<?php	
			echo $this->Form->create( 'User', array(
			'class' => 'form-horizontal', 
			'role' => 'form',
			'inputDefaults' => array(
				'format' => array( 'before', 'label', 'between', 'input', 'error', 'after' ),
				'div' => array( 'class' => 'form-group has-succes has-feedback' ),
				'class' => array( 'form-control' ),
				'label' => array( 'class' => 'col-lg-2 control-label' ),
				'between' => '<div class="col-md-4">',
				'after' => '</div>',
				'error' => array( 'attributes' => array( 'wrap' => 'span', 'class' => 'help-inline' ) ),
			))); 


			echo $this->Form->input( 'id', array(
				'type' => 'hidden'
			) );

			echo $this->Form->input( 'username', array(
				'placeholder' => 'Felhasználónév...',
				'label' => false
			) );

			echo $this->Form->input( 'password', array(
				'placeholder' => 'Jelszó...',
				'label' => false 
			) );
		?>

		<div class="login-button">
			<?php 
				echo $this->Form->button( __( 'Bejelentkezés' ), array(
					'class' => 'btn btn-primary'
			) ); 
			?>
		</div>

		<?php echo $this->Form->end(); ?>

		<div class="forgot-password-link" id="forgot-password-link">
			<?php 
				echo $this->Html->link(__( 'Elfelejtetted a jelszavad?' ), array( 
					'controller' => 'users', 
					'action' => 'forgot_password' 
			) );
			?>
		</div>
	</div>
</div>