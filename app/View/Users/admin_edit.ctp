<div class="users form">

	<?php 
		echo $this->Form->create( 'User' ); 
	?>

	<fieldset>
		<?php
			echo $this->Form->input( 'id' );

			echo $this->Form->input( 'username', array(
				'label' => 'Felhasználonév'
			) );

			echo $this->Form->input( 'fullname', array(
				'label' => 'Teljes név'
			) );

			echo $this->Form->input( 'password', array(
				'label' => 'Jelszó'
			) );

			echo $this->Form->input( 'email', array(
				'label' => 'Email'
			) );

			echo $this->Form->input( 'role', array(
				'label' => 'Jogosultság'
			) );
		?>
	</fieldset>

	<?php 
		echo $this->Form->end(__( 'Modositás' ) ); 
	?>
</div>

<div class="actions">
	<ul>
		<li>
			<?php 
				echo $this->Form->postLink(__( 'Törlés' ), array(
					'action' => 'delete', 
					$this->Form->value('id')),
					 null, __( 'Biztos le akkarod törölni a felhasználot?', 
				 	$this->Form->value('id') 
			 	) ); 
			 ?>
		</li>

		<li>
			<?php 
				echo $this->Html->link(__( 'Felhasználok listázása' ), array(
			 		'action' => 'index' 
		 		) ); 
			?>
		</li>
	</ul>
</div>
