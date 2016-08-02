<div class="forgot-password-container">
	<div class="information-box">
		 <ol>
			<li> 
				<?php echo __( 'Ha <b>elfelejtetted a jelszavad</b>,írd be az <b>email címed</b>,amivel korábban regisztráltál és add meg a képen található <b>biztonsági kódot</b>.' ); ?> 
			</li>
			<li> 
				<?php echo __( 'Rendszerünk <b>e-mailben</b> fog küldeni egy linket aminek segitségével
							 <b>új jelszót adhatsz meg</b>,ennek a segitségével beléphetsz rendszerünkbe és <b>kezelheted a hirdetéseidet</b>.' ); 
				 ?>
			</li>
		</ol>
	</div>
	
	<div class="forgot-password-box-container">
		<legend>
			<?php echo __( 'Elfelejtett jelszó!' ); ?>

			<?php 
				echo $this->Html->image( 'forgot.png', array(
					'alt' => __( 'Elfelejtett jelszó' )
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
					'between' => '<div class="col-md-7">',
					'after' => '</div>',
					'error' => array( 'attributes' => array( 'wrap' => 'span', 'class' => 'help-inline' ) ),
			)));

		?>

		<div class="forgot-password-box">
			<?php
				echo $this->Form->input( 'email', array(
					 'label' => false,
					'placeholder' => 'Irja be a valós e-mail cimed,és elküldjük az új jelszavadat a megadott e-mail cimedre!' 
				) );
			?>
		</div>

		<?php
			echo $this->Recaptcha->display( array( 
		  		'recaptchaOptions' => array( 
				'theme' => 'clean' 
			) ) );
		?>

		<div class="forgot-password-button">
			<?php 
				echo $this->Form->button( __( 'Kérem az új jelszavamat' ), array(
					'class' => 'btn btn-primary'
			) ); 
			?>
		</div>
	</div>
</div>

 
			