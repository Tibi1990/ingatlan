<div class="users form">
	<?php 
		echo $this->Form->create( 'Listing' ); 
	?>

	<fieldset>
		<?php
			echo $this->Form->input( 'id' );

			echo $this->Form->input( 'city', array(
				'label' => 'Város'
			) );

			echo $this->Form->input( 'status_rent', array(
				'label' => 'Eladó/Kiadó'
			) );

			echo $this->Form->input( 'address', array(
				'label' => 'Cím'
			) );

			echo $this->Form->input( 'status', array(
				'label' => 'Lakás/Ház'
			) );

			echo $this->Form->input( 'state', array(
				'label' => 'Berendezés'
			) );

			echo $this->Form->input( 'size', array(
				'label' => 'Ingatlan mérete'
			) );

			echo $this->Form->input( 'numbers_room', array(
				'label' => 'Ingatlan szobák száma'
			) );

			echo $this->Form->input( 'heating', array(
				'label' => 'Fűtés'
			) );

			echo $this->Form->input( 'parking', array(
				'label' => 'Parkolás'
			) );

			echo $this->Form->input( 'rent_price', array(
				'label' => 'Ingatlan bérleti dija'
			) );

			echo $this->Form->input( 'deposit', array(
				'label' => 'Kaukció'
			) );

			echo $this->Form->input( 'description_hu', array(
				'label' => 'Ingatlanról leírás'
			) );

			echo $this->Form->input( 'deleted', array(
				'label' => 'Törölt ingatlan'
			) );

			echo $this->Form->input( 'highlight', array(
				'label' => 'Kiemelt ingatlan'
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
				echo $this->Form->postLink(__( 'Ingatlan törlése' ), array(
					'action' => 'delete', 
					$this->Form->value('id')),
					 null, __( 'Biztos le akkarod törölni a felhasználot?', 
				 	$this->Form->value('id') 
			 	) ); 
			 ?>
		</li>

		<li>
			<?php 
				echo $this->Html->link(__( 'Ingatlanok listázása' ), array(
			 		'action' => 'index' 
		 		) ); 
			?>
		</li>
	</ul>
</div>
