<div class="registration-form">
	<div class="registration-form-inner">
		<fieldset>
			<legend>
				<?php
					echo __( 'Regisztráció' );
				?>
			</legend>
			<?php 
				echo $this->Form->create( 'User', array(
					'type' => 'file',
					'class' => 'form-horizontal', //(form-vertical, form-inline)
					'role' => 'form', //?
					'inputDefaults' => array(
						'format' => array(
							'before',
							'label',
							'between',
							'input',
							'error',
							'after'
						),
						'div' => array( 'class' => 'form-group' ), //Separate inpt(margin-bottom:15px)
						'class' => array( 'form-control' ), //Pretty bootstrap style 
						'label' => array( 'class' => 'col-lg-2 control-label' ),
						'between' => '<div class="col-md-7">',
						'after' => '</div>',
						'error' => array(
							'attributes' => array(
								'wrap' => 'span',
								'class' => 'text-danger'
							)
						)
					))); 

				echo $this->Form->input( 'User.username',
					array( 
						'placeholder' => __( 'Felhasználonévnek minimum 5-karaktert meg kell adni!' ),
						'label' => __( 'Felhasználonév' )
				) );

				echo $this->Form->input( 'User.fullname' ,
					array( 
						'placeholder' => __( 'Teljes névnek minimum 3-karaktert meg kell adni!' ),
						'label' => __( 'Teljes név' ) 
				) );

				echo $this->Form->input( 'User.password' ,
					array(
				 		'placeholder' => __( 'Jelszó minimum-5 maximum-20 karaktert tartalmazhat!' ),
				 		'type' => 'password',
				 		'label' => __( 'Jelszó' ),
			 	) );

				echo $this->Form->input( 'User.password_confirmation',
					array( 
						'placeholder' => __( 'Jelszó újra!' ),
						'type' => 'password',
						'label' => __( 'Jelszó újra' )
		 		) );

				echo $this->Form->input( 'User.email',
					array(
				 		'placeholder' => __( 'Kérem valós e-mail címet adjon meg!' ),
				 		'label' => __('Email')	
			  	) );

			  	echo $this->Form->input( 'User.phone',
			  		array(
				 		'placeholder' => __( 'Telefonszám!' ),
				 		'label' => __( 'Telefonszám' )	
			  	) );

			  	echo $this->Form->input( 'User.user_photo' ,
			  		array(
			  			'type' => 'file',
				 		'label' => __( 'Töltsd fel magadról a kedvenc képedet!' ),
				 		'class' => false
			  	) );

			  	/*
			  	*Show recaptcha
			  	*/
			  	echo $this->Recaptcha->display( array( 
			  		'recaptchaOptions' => array( 
			  			'theme' => 'clean' 
		  			) ) );
			?>
			
			<!-- Registration button -->
			<div class="registration-button">
				<?php 
					echo $this->Form->button(__( 'Regisztráció' ),
						array(
							'class' => 'btn btn-primary' //Bootstrap style	
					) );
				?>
			</div>
			
			<?php
				//End the form.
				echo $this->Form->end();
			?>
		</div>
	</fieldset>	
</div>
