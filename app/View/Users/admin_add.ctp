<div class="users form">
	<?php 
		echo $this->Form->create( 'User' ); 
	?>

	<fieldset>
		<?php
			echo $this->Form->input( 'id', array(
				'type' => 'hidden' 
			) );

			echo $this->Form->input( 'username', array(
				'label' => 'Felhasználonév',
				'placeholder' => 'Felhasználonévnek minimum 5-karaktert kell megadni!!'
				
			) );

			echo $this->Form->input( 'fullname', array(
				'label' => 'Teljes név',
				'placeholder' => 'Teljes névnek minimum 3- karaktert kell megadni!!'
			) );

			echo $this->Form->input( 'password', array(
				'label' => 'Jelszó',
				'placeholder' => 'Jelszó mezőnek minimum 5 karaktert meg kell adni!!'
			) );

			echo $this->Form->input( 'email', array(
				'label' => 'Email',
				'placeholder' => 'Kérlek valós email címet adjál meg!!'
			) );
		?>
	</fieldset>

	<?php 
		echo $this->Form->end(__( 'Felhasználó létrehozása' ) ); 
	?>
</div>

<div class="actions">
	<ul>
		<li>
			<?php 
				echo $this->Html->link(__( 'Felhasználok listázása' ), array(
					'action' => 'index' 
				) ); 
			?>
		</li>
	</ul>
</div>
