<span class="index-label">
	<?php echo __( 'Oldal hibák' ); ?> 
</span>

<table cellpadding="0" cellspacing="0">
	<tr>
		<th>
			<?php echo $this->Paginator->sort( 'id', 'ID' ); ?>
		</th>

		<th>
			<?php echo $this->Paginator->sort( 'name', 'Név' ); ?>
		</th>

		<th>
			<?php echo $this->Paginator->sort( 'subject', 'Tárgy' ); ?>
		</th>

		<th>
			<?php echo $this->Paginator->sort( 'email', 'Email' ); ?>
		</th>
		
		<th>
			<?php echo $this->Paginator->sort( 'description', 'Hiba leírása' ); ?>
		</th>

		<th>
			<?php echo $this->Paginator->sort( 'created', 'Időpont' ); ?>
		</th>
		
		<th>
			<?php echo $this->Paginator->sort( 'modified', 'Modositva' ); ?>
		</th>
		
		 <th></th> <!--Megtekintes,szerkesztes,torles gombok felett a csik vegigmennyen -->
	</tr>

	<?php 
		foreach ( $errors as $error ):
	?>

	<tr>
		<td>
			<?php echo h( $error['Connection']['id'] ); ?>&nbsp;
		</td>

			<td>
			<?php echo h( $error['Connection']['name'] ); ?>&nbsp;
		</td>

		<td>
			<?php echo h( $error['Connection']['subject'] ); ?>&nbsp;
		</td>

		<td>
			<?php echo h( $error['Connection']['email'] ); ?>&nbsp;
		</td>

		<td>
			<?php echo h( $error['Connection']['description'] ); ?>&nbsp;
		</td>

		<td>
			<?php echo h( $error['Connection']['created'] ); ?>&nbsp;
		</td>
		
		<td>
			<?php echo h( $error['Connection']['modified'] ); ?>&nbsp;
		</td>

			<td class="actions">
			<?php
				echo $this->Html->link(__( 'JAVITVA' ),
					array(
						'controller' => 'connections',
						'action' => 'fixed_error',
						$error['Connection']['id'],
						'admin' => true 
				) ); 
			?>
		</td>
	
	<?php endforeach; ?>
</table>

<p>
	<!-- Count page -->
	<?php
		echo $this->Paginator->counter(array(
			'format' => __('Oldalak {:page} száma {:pages}, megjelenés {:current} sorok száma {:count} teljes, sorok száma kezdödik {:start}, véget ér {:end}')
	));
	?>	
</p>

<!-- Paginator next,prev -->
<div class="paging">
	<?php
		echo $this->Paginator->prev( '< ' . __( 'Elöző' ), array(), null, array( 'class' => 'prev disabled'  ) );

		echo $this->Paginator->numbers( array( 'Szétválasztó' => '' ) );

		echo $this->Paginator->next(__( 'Következő ') . ' >', array(), null, array( 'class' => 'next disabled' ) );
	?>
</div>

