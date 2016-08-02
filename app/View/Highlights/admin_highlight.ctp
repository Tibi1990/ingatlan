<span class="index-label">
	<?php echo __( 'Felhasználok kiemeléseinek adatai!' ); ?> 
</span>

<table cellpadding="0" cellspacing="0">
	<tr>
		<th>
			<?php echo $this->Paginator->sort( 'id', 'ID' ); ?>
		</th>

		<th>
			<?php echo $this->Paginator->sort( 'listing_id', 'Hirdetés.ID' ); ?>
		</th>

		<th>
			<?php echo $this->Paginator->sort( 'user_id', 'Felhasználó.ID' ); ?>
		</th>

		<th>
			<?php echo $this->Paginator->sort( 'type', 'Kiemelés típusa' ); ?>
		</th>
		
		<th>
			<?php echo $this->Paginator->sort( 'price', 'Kiemelés ára' ); ?>
		</th>

		<th>
			<?php echo $this->Paginator->sort( 'created', 'Létrehozva' ); ?>
		</th>
		
		<th>
			<?php echo $this->Paginator->sort( 'modified', 'Modositva' ); ?>
		</th>

		 <th></th> <!--Megtekintes,szerkesztes,torles gombok felett a csik vegigmennyen -->
	</tr>

	<?php 
		foreach ( $highlightListings as $highlight ):
	?>

	<tr>
		<td>
			<?php echo h( $highlight['Highlight']['id'] ); ?>&nbsp;
		</td>

			<td>
			<?php echo h( $highlight['Highlight']['listing_id'] ); ?>&nbsp;
		</td>

		<td>
			<?php echo h( $highlight['Highlight']['user_id'] ); ?>&nbsp;
		</td>

		<td>
			<?php echo h( $highlight['Highlight']['type'] ); ?>&nbsp;
		</td>

		<td>
			<?php echo h( $highlight['Highlight']['price'] ); ?>&nbsp;
		</td>

		<td>
			<?php echo h( $highlight['Highlight']['created'] ); ?>&nbsp;
		</td>
		
		<td>
			<?php echo h( $highlight['Highlight']['modified'] ); ?>&nbsp;
		</td>

		<td class="actions">
			<?php
				/**
				*Highlight details
				*/ 
				echo $this->Html->link(__( 'Hirdetés megtekintése' ), array(
					'controller' => 'highlights',
					'action' => 'admin_view',
					'admin' => true,
					$highlight['Highlight']['listing_id'] 
				) );
		
				/**
				*Highlight delete
				*/ 
				echo $this->Html->link(__( 'Hirdetés törlése' ), array(
					'controller' => 'highlights',
					'action' => 'admin_delete',
					'admin' => true,
					$highlight['Highlight']['id'] 
				) );
			?>
		</td> 
	</tr>

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

