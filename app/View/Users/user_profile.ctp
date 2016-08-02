<div id="mainsearch" style="display:none;">
	<?php
		echo $this->element('search/mainsearch');
	?>
</div>
<!-- USER PROFILE -->
<div id="profile">
	<div class="error-message" style="clear:both;padding:15px;">
		<p class="highlight-bold">
			<u><?php echo __('SAJÁT PROFILOM LEHETŐSÉGEK!!'); ?></u>
		</p>

		<ol>
			<li class="highlight-bold">
				<?php 
					echo __('PROFILOM SZERKESZTÉSE');
				?> 
			</li>

			<li class="highlight-bold">
				<?php
					echo __('AKTIV HIRDETÉSEIM LISTÁZÁSA');
				?> 
			</li>

			<li class="highlight-bold">
				<?php 
					echo __('INAKTIV HIRDETÉSEIM LISTÁZÁSA');
				?>
			</li>
		</ol>
	</div>

	<div class="profile-aktiv-inaktiv-listings">
		<div class="activ-listings">
			<?php
				//AKTIV LISTINGS BUTTONS
				echo $this->Html->link(__( 'AKTIV HIRDETÉSEIM MEGTEKINTÉSE!' ),
					array(
						'controller' => 'listings',
						'action' => 'activ_listing',
						'admin' => false
					),
					array(
						'class' => 'btn btn-primary btn-md',
						'title' => __('Aktiv hirdetések listázása')
					)	
				);
			?>
		</div>

		<div class="inactiv-listings">
			<?php
				//INAKTIV LISTINGS BUTTONS
				echo $this->Html->link(__( 'INAKTIV HIRDETÉSEIM MEGTEKINTÉSE!' ),
					array(
						'controller' => 'listings',
						'action' => 'inactiv_listing',
						'admin' => false
					),
					array(
						'class' => 'btn btn-danger btn-md',
						'title' => __('Inaktiv hirdetések listázása')
					)	
				);
			?>
		</div>

		<div class="favorite-listings">
			<?php
				//FAVORITE LISTINGS BUTTONS
				echo $this->Html->link(__( 'KEDVENC HIRDETÉSEIM MEGTEKINTÉSE!' ),
					array(
						'controller' => 'favorites',
						'action' => 'show_favorite',
						'admin' => false
					),
					array(
						'class' => 'btn btn-success btn-md',
						'title' => __('Kedvenc hirdetések listázása')
					)	
				);
			?>
		</div>

		<div class="clear"></div>
	</div>

	<div id="profile-table">
		<table class="table table-striped table-bordered">
			<tr>
				<th class="info"> <?php echo __( 'PROFIL ADATOK' ); ?> </th>
				<th class="info"> <?php echo __( 'PROFIL INFORMÁCIÓK' ); ?> </th>
			</tr>
			
			<tr>
				<td style="vertical-align:middle;">
					<?php echo __( '<span class="highlight-bold">Fénykép rólad</span>' ); ?>
				</td>

				<td> 
					<?php
						/*If the user has profile image*/
						if(!empty($currentUser['user_photo']))
						{
							echo $this->Html->image(
							'users_photos/' . 'thumb_' . $currentUser['user_photo'],
							array(
								'width' => '100px',
								'height' => '100px'	
							));
						}
						else
						{
							//If the user has no profil image!
							echo __('Töltsd fel magadrol a kedvenc képedet!<b> A profil szerkesztése gombra kattintva!</b>');
						}
					?>
				</td>
			</tr>

			<tr>
				<td> <?php echo __( '<span class="highlight-bold">Felhasználonév</span' ); ?> </td>
				<td> <?php echo $currentUser['username']; ?> </td>
			</tr>

			<tr>
				<td> <?php echo __( '<span class="highlight-bold">Teljes név<span>' ); ?> </td>
				<td> <?php echo $currentUser['fullname']; ?> </td>
			</tr>

			<tr>
				<td> <?php echo __( '<span class="highlight-bold">Email</span>' ); ?> </td>
				<td> <?php echo $currentUser['email']; ?> </td>
			</tr>
			
			<tr>
				<td> <?php echo __( '<span class="highlight-bold">Telefonszám</span>' ); ?> </td>
				<td> <?php echo $currentUser['phone']; ?> </td>
			</tr>

			<tr>
				<td> <?php echo __( '<span class="highlight-bold">Aktiv hirdetések száma</span>' ); ?> </td>
				<td> <?php echo $userActivListingCount ?> </td>
			</tr>
			
			<tr>
				<td> <?php echo __( '<span class="highlight-bold">Inaktiv hirdetések száma</span>' ); ?> </td>
				<td> <?php echo $userInactivListingCount; ?> </td>
			</tr>
			
			<tr>
				<td> <?php echo __( '<span class="highlight-bold">Kedvenc hirdetések száma</span>' ); ?> </td>
				<td>
					<?php
						/**
						*Count favorite listings
						*Show the user profile
						*/
						echo $number;
					?>
				</td>
			</tr>
		</table>
	</div>
	
	<?php 
		echo $this->Html->link(__( 'Profil szerkesztése' ),
			array(
				'controller' => 'users',
				'action' => 'profile_edit',
				'admin' => false
			),
			array(
				'class' => 'btn btn-danger'
			)	
		);
	?>
</div>