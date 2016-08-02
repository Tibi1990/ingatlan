<div id="problem-message">
	<div class="information-box">
		<ol>
		 	<li> 
		 		<?php echo __( 'Ha az oldalon bármilyen <b>működési hibát</b> észrevett kérem jelezzen!' ); ?> 
	 		</li>

		 	<li>
		 		<?php echo __( 'Kérem csak <b>valós</b> adatokat adjon meg!' ); ?> 
	 		</li>
		</ol>
	</div>
	
	<fieldset>
		<legend> <?php echo __( 'Kapcsolat' ); ?> </legend>
		<?php 
			echo $this->Form->create( 'Connection', array(
				'class' => 'form-horizontal', 
				'role' => 'form',
				'inputDefaults' => array(
					'format' => array( 'before', 'label', 'between', 'input', 'error', 'after' ),
					'div' => array( 'class' => 'form-group' ),
					'class' => array( 'form-control' ),
					'label' => array( 'class' => 'col-lg-2 control-label' ),
					'between' => '<div class="col-md-7">',
					'after' => '</div>',
					'error' => array( 'attributes' => array( 'wrap' => 'span', 'class' => 'help-inline' ) )
			))); 

			echo $this->Form->input( 'name', array(
				'label' => false,
				'placeholder' => __( 'Teljes név...' )
			) );

			echo $this->Form->input( 'subject', array(
				'label' => false,
				'placeholder' => __( 'Tárgy...' )
			) );

			echo $this->Form->input( 'email', array(
				'label' => false,
				'placeholder' => __( 'Email cím...' )
			) );

			echo $this->Form->input( 'description', array(
				'label' => false,
				'placeholder' => __( 'Leírás...' )
			) );

			echo $this->Recaptcha->display( array( 
		  		'recaptchaOptions' => array( 
		  			'theme' => 'clean' 
			) ) );
			
			echo "<br />";

			echo $this->Form->button(__( 'Üzennet elküldése' ),array(
				'class' => 'btn btn-primary'
			) );
			

			echo $this->Form->end();
	 	?>
 	</fieldset>

</div>