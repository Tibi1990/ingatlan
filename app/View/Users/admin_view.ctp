<div class="users view">
	<dl>
		<dt>
			<?php echo __( 'Azonosító' ); ?>
		</dt>

		<dd>
			<?php echo h( $user['User']['id'] ); ?>
			&nbsp;
		</dd>

		<dt>
			<?php echo __( 'Felhasználonév' ); ?>
		</dt>

		<dd>
			<?php echo h( $user['User']['username'] ); ?>
			&nbsp;
		</dd>

		<dt>
			<?php echo __( 'Teljes név' ); ?>
		</dt>

		<dd>
			<?php echo h( $user['User']['fullname'] ); ?>
			&nbsp;
		</dd>

		<dt>
			<?php echo __( 'Email' ); ?>
		</dt>

		<dd>
			<?php echo h( $user['User']['email'] ); ?>
			&nbsp;
		</dd>

		<dt>
			<?php echo __( 'Jogosultság' ); ?>
		</dt>

		<dd>
			<?php echo h( $user['User']['role'] ); ?>
			&nbsp;
		</dd>

		<dt>
			<?php echo __( 'Létrehozva' ); ?>
		</dt>

		<dd>
			<?php echo h( $user['User']['created'] ); ?>
			&nbsp;
		</dd>

		<dt>
			<?php echo __( 'Módosítva' ); ?>
		</dt>

		<dd>
			<?php echo h( $user['User']['modified'] ); ?>
			&nbsp;
		</dd>

		<dt>
			<?php echo __( 'Fénykép' ); ?>
		</dt>

		<dd>
			<?php
				echo $this->Html->image(
					'users_photos/' . $user['User']['user_photo'],
					array(
						'alt' => __('Felhasználó fényképe'),
						'class' => 'admin-user-photo'
					)
				);

			?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="actions">
	<ul>
		<li>
			<?php
				echo $this->Html->link(__( 'Felhasználó szerkesztése' ),array(
					'action' => 'edit',
				 	$user['User']['id'] 
			 	) );
	 		 ?> 
		</li>

		<li>
			<?php 
				echo $this->Form->postLink(__( 'Felhasználó törlése' ),array(
					'action' => 'delete',
				 	$user['User']['id'] ),
				  	null, __( 'Biztos le akkarod törölni a felhasználot?', $user['User']['id'] 
		  		) ); 
			 ?> 
		</li>

		<li>
			<?php 
				echo $this->Html->link(__( 'Felhasználok listázása' ),array(
					'action' => 'index' 
			) ); 
			?>
		</li>

		<li>
			<?php
				 echo $this->Html->link(__( 'Felhasználó hozzáadása' ),array(
			 		'action' => 'add' 
	 		) ); 
			?>	 
		</li>
	</ul>
</div>
