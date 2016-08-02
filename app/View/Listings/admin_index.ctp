<span class="index-label">
	<?php echo __( 'Felhasználok hirdetéseinek adatai' ); ?> 
</span>

<table cellpadding="0" cellspacing="0">
	<tr>
		<th>
			<?php echo $this->Paginator->sort( 'id', 'ID' ); ?>
		</th>

		<th>
			<?php echo $this->Paginator->sort( 'id', 'Felhasználó.ID' ); ?>
		</th>

		<th>
			<?php echo $this->Paginator->sort( 'city', 'Város' ); ?>
		</th>

		<th>
			<?php echo $this->Paginator->sort( 'address', 'Cím' ); ?>
		</th>
		
		<th>
			<?php echo $this->Paginator->sort( 'status', 'Lakás/Ház' ); ?>
		</th>

		<th>
			<?php echo $this->Paginator->sort( 'status_rent', 'Eladó / Kiadó' ); ?>
		</th>
		
		<th>
			<?php echo $this->Paginator->sort( 'deleted', 'Törölt' ); ?>
		</th>
		
		<th>
			<?php echo $this->Paginator->sort( 'highlight', 'Kiemelt' ); ?>
		</th>

		<th>
			<?php echo $this->Paginator->sort( 'admin_aktiv', 'Admin' ); ?>
		</th>

		<th>
			<?php echo $this->Paginator->sort( 'created', 'Létrehozva ' ); ?>
		</th>

		<th>
			<?php echo $this->Paginator->sort( 'modified', 'Modositva' ); ?>
		</th>

		 <th></th> <!--Megtekintes,szerkesztes,torles gombok felett a csik vegigmennyen -->
	</tr>

	<?php 
		foreach ( $listings as $listing ):
	?>

	<tr>
		<td>
			<?php echo h( $listing['Listing']['id'] ); ?>&nbsp;
		</td>

			<td>
			<?php echo h( $listing['User']['id'] ); ?>&nbsp;
		</td>

		<td>
			<?php echo h( $listing['Listing']['city'] ); ?>&nbsp;
		</td>

		<td>
			<?php echo h( $listing['Listing']['address'] ); ?>&nbsp;
		</td>

		<td>
			<?php echo h( $listing['Listing']['status'] ); ?>&nbsp;
		</td>

		<td>
			<?php echo h( $listing['Listing']['status_rent'] ); ?>&nbsp;
		</td>
		
		<td>
			<?php echo h( $listing['Listing']['deleted'] ); ?>&nbsp;
		</td>
		
		<td>
			<?php echo h( $listing['Listing']['highlight'] ); ?>&nbsp;
		</td>


		<td>
			<?php echo h( $listing['Listing']['admin_aktiv'] ); ?>&nbsp;
		</td>

		<td>
			<?php echo h( $listing['Listing']['created'] ); ?>&nbsp;
		</td>

		<td>
			<?php echo h( $listing['Listing']['modified'] ); ?>&nbsp;
		</td>

		<td class="actions">
			<?php
				/**
				*View listing details(all)
				*/ 
				echo $this->Html->link(__( 'Megtekintés' ), array(
					'action' => 'view',
					$listing['Listing']['id'] 
				) ); 
				
				/**
				*Edit listing details(all)
				*/ 
				echo $this->Html->link(__( 'Szerkesztés' ),array(
					'action' => 'edit',
					$listing['Listing']['id'] 
				) ); 
				
				/**
				*Delete listing
				*/ 
				echo $this->Form->postLink(__( 'Törlés' ),array(
					'action' => 'delete',
					$listing['Listing']['id'] ),
					null, __( 'Biztos le akkarod törölni a felhasználot?', $listing['Listing']['id']) );

				/**
				*Admin aktiv listing
				*/ 
				echo $this->Html->link(__( 'Aktiválás' ),
					array(
						'controller' => 'listings',
						'action' => 'admin_aktiv',
						$listing['Listing']['id']
					),
					array(
						'confirm' => __('Biztos hogy aktiválni szeretnéd a hirdetésed?') 
				 ));

				/**
				*Admin inaktiv listing
				*/ 
				echo $this->Html->link(__( 'Inaktiválás' ),
					array(
						'controller' => 'listings',
						'action' => 'admin_inaktiv',
						$listing['Listing']['id']
					),
					array(
					'confirm' => __('Biztos hogy inaktiválni szeretnéd a hirdetésed?')  
			 	));  
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

