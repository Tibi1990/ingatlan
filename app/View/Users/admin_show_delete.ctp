<span class="index-label">
	<?php echo __( 'Törölt felhasználok adatai' ); ?> 
</span>

<table cellpadding="0" cellspacing="0">
	<tr>
		<th>
			<?php echo $this->Paginator->sort( 'id', 'Id' ); ?>
		</th>

		<th>
			<?php echo $this->Paginator->sort( 'username', 'Felhasználonév' ); ?>
		</th>

		<th>
			<?php echo $this->Paginator->sort( 'fullname', 'Név' ); ?>
		</th>

		<!-- <th>
			<?php/* echo $this->Paginator->sort( 'password', 'Jelszó' );*/ ?>
		</th> -->

		<th>
			<?php echo $this->Paginator->sort( 'email', 'Email' ); ?>
		</th>

		<th>
			<?php echo $this->Paginator->sort( 'role', 'Jogosultság' ); ?>
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
		foreach ($users as $user): 
	?>

	<tr>
		<td>
			<?php echo h( $user['User']['id'] ); ?>&nbsp;
		</td>

		<td>
			<?php echo h( $user['User']['username'] ); ?>&nbsp;
		</td>

		<td>
			<?php echo h( $user['User']['fullname'] ); ?>&nbsp;
		</td>

		<!-- <td>
			<?php /*echo h( $user['User']['password'] ); */?>&nbsp;
		</td> -->

		<td>
			<?php echo h( $user['User']['email'] ); ?>&nbsp;
		</td>

		<td>
			<?php echo h( $user['User']['role'] ); ?>&nbsp;
		</td>

		<td>
			<?php echo h( $user['User']['created'] ); ?>&nbsp;
		</td>

		<td>
			<?php echo h( $user['User']['modified'] ); ?>&nbsp;
		</td>

		<td class="actions">
			<?php 
				echo $this->Html->link(__( 'Megtekintés' ), array(
					'action' => 'view',
					$user['User']['id'] 
				) ); 
			
				echo $this->Html->link(__( 'Szerkesztés' ),array(
					'action' => 'edit',
					$user['User']['id'] 
				) ); 
			
				echo $this->Form->postLink(__( 'Törlés' ),array(
					'action' => 'delete',
					$user['User']['id'] ),
					null, __( 'Biztos le akkarod törölni a felhasználot?', $user['User']['id']) );

				echo $this->Html->link(__( 'AKTIVÁLÁS' ),array(
					'controller' => 'users',
					'action' => 'delete_activation',
					'admin' => true,
					$user['User']['id'] ),
					null, __( 'Biztos aktiválni akkarod??', $user['User']['id']) );
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