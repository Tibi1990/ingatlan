<div class="highlight-wrapper">
	<div class="highlight-first-box">
		<h4 class="center-bold"> <?php echo __('EGY NAPOS KIEMELÉS') ?> </h4>
		<p class="text-format">
			<?php echo __('<b>Egy napig</b> ki lesz emelve a hirdetésed a főoldalra!Egy napos kiemelésnek az ára <b>100 RSD</b>.'); ?>
		</p>

		<?php
			//Send the data in the controller
			echo $this->Form->create('Highlight'); 
	
			echo $this->Form->input('listing_id',
				array(
					'type' => 'hidden',
					'value' => $this->params['pass']
				)
			);

			echo $this->Form->input('user_id',
				array(
					'type' => 'hidden',
					'value' => $this->Session->read('Auth.User.id')
				)
			);

			echo $this->Form->input('type',
				array(
					'type' => 'hidden',
					'value' => 'Egy napos'
				)
			);

			echo $this->Form->input('price',
				array(
					'type' => 'hidden',
					'value' => 100
				)
			);

			/**
			*Highlights button style.
			*/
			$highlightOptionsButton = array(
    			'label' => __('KIEMELEM A HIRDETEÉSEM'),
    			'div' => array(
        			'class' => 'highlights-button'
		 		)
			);

			/**
			*Megrendelem gomb.
			*/
			echo $this->Form->end( $highlightOptionsButton );
		?>
	</div>

	<div class="highlight-second-box">
		<h4 class="center-bold"> <?php echo __('HÁROM NAPOS KIEMELÉS') ?> </h4>
		<p class="text-format">
			<?php echo __('<b>Három napig</b> ki lesz emelve a hirdetésed a főoldalra!Három napos kiemelésnek az ára <b>300 RSD</b>'); ?>
		</p>

		<?php
			echo $this->Form->create('Highlight'); //Send the data in the controller
	
			echo $this->Form->input('listing_id',
				array(
					'type' => 'hidden',
					'value' => $this->params['pass']
				)
			);
			echo $this->Form->input('user_id',
				array(
					'type' => 'hidden',
					'value' => $this->Session->read('Auth.User.id')
				)
			);

			echo $this->Form->input('type',
				array(
					'type' => 'hidden',
					'value' => 'Harom napos'
				)
			);

			echo $this->Form->input('price',
				array(
					'type' => 'hidden',
					'value' => 300
				)
			);

			echo $this->Form->end($highlightOptionsButton);
		?>
	</div>

	<div class="highlight-third-box">
		<h4 class="center-bold"> <?php echo __('EGY HETES KIEMELÉS') ?> </h4>
		<p class="text-format">
			<?php echo __('<b>Egy hétig</b> ki lesz emelve a hirdetésed a főoldalra!Egy hetes kiemelésnek az ára <b>700 RSD</b>'); ?>
		</p>

		<?php
			echo $this->Form->create('Highlight');

			echo $this->Form->input('listing_id',
				array(
					'type' => 'hidden',
					'value' => $this->params['pass']
				)
			);
			echo $this->Form->input('user_id',
				array(
					'type' => 'hidden',
					'value' => $this->Session->read('Auth.User.id')
				)
			);

			echo $this->Form->input('type',
				array(
					'type' => 'hidden',
					'value' => 'Egy hetes'
				)
			);

			echo $this->Form->input('price',
				array(
					'type' => 'hidden',
					'value' => 700
				)
			);

			echo $this->Form->end($highlightOptionsButton);
		?>
	</div>

	<div class="clear"></div>
</div>