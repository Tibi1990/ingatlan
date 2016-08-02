<!--Hirdetésmegtekintés-->
<?php foreach( $getListingInfos as $getListingInfo  ): ?>

<div id="listing-details-wrapper">
	<div class="listing-details">
		<table class="table table-striped table-hover">
			<tr>
				<td> <?php echo __( 'Város' ); ?> </td>
				<td> <?php echo $getListingInfo['Listing']['city']; ?> </td>
			</tr>

			<tr>
				<td> <?php echo __( 'Cim' ); ?> </td>
				<td> <?php echo $getListingInfo['Listing']['address']; ?> </td>
			</tr>

			<tr>
				<td> <?php echo __( 'Ingatlan tipusa' ); ?> </td>
				<td> <?php echo $getListingInfo['Listing']['status']; ?> </td>
			</tr>

			<tr>
				<td> <?php echo __( 'Állapota' ); ?> </td>
				<td> <?php echo $getListingInfo['Listing']['state']; ?> </td>
			</tr>

			<tr>
				<td> <?php echo __( 'Méret' ); ?> </td>
				<td> <?php echo $getListingInfo['Listing']['size']; ?> </td>
			</tr>

			<tr>
				<td> <?php echo __( 'Szobák száma' ); ?> </td>
				<td> <?php echo $getListingInfo['Listing']['numbers_room']; ?> </td>
			</tr>

			<tr>
				<td> <?php echo __( 'Fütés' ); ?> </td>
				<td> <?php echo $getListingInfo['Listing']['heating']; ?> </td>
			</tr>

			<tr>
				<td> <?php echo __( 'Bérleti dij' ); ?> </td>
				<td> <?php echo $getListingInfo['Listing']['rent_price']; ?> </td>
			</tr>

			<tr>
				<td> <?php echo __( 'Kaució' ); ?> </td>
				<td> <?php echo $getListingInfo['Listing']['deposit']; ?> </td>
			</tr>
		</table>
	</div>
	<!--HM ingatlanról képek,infok stb... -->
	<div class="user-details">
		<div class="user-details-inner">
			<div class="user-image">
				<!-- Show the USER PHOTO -->
				<a class="fancybox" href=<?php echo "/diploma/img/users_photos/" . "thumb_" . $getListingInfo['User']['user_photo' ] ?> >
					<?php
					/**
					*Listing details show user photo
					*/
					echo $this->Html->image( "users_photos/" . "thumb_" . 
						$getListingInfo['User']['user_photo' ],
							array(
							'width' => '200px',
							'height' => '200px',
							'alt' => __('Hirdető fényképe')
						)
					);
					?>
				</a>
			</div>
		
			<div class="user-info">
				<div class="user-phone">
					<?php
						echo $this->Html->image( 'phone.png',
							array(
								'height' => '70px',
								'alt' => __('Telefon')
						) );
						
						echo "<span class=website-color-orange>" . $getListingInfo['User']['phone'] . "</span>";
					?>
				</div>

				<div class="user-fullname">
					<?php
						echo "<b>Hirdető neve:</b> <span class=website-color-orange>" . $getListingInfo['User']['fullname'] . "</span>";
					?>
				</div>
			</div>
		</div>

		<div class="listing-description">
			<div class="description-inner">
				<span class="text-format"> <?php echo __( 'Leírás az ingatlanról!' ); ?> </span>

				<div class="description-inner-inner">
					<textarea cols="70" rows="4" readonly="readonly"><?php echo $getListingInfo['Listing']['description_hu']; ?></textarea>
				</div>
			</div>

			<hr /> 
			<!--Start listing image -->
			<div class="description-inner-image">
				<span class="text-format"> <?php echo __( 'Képek az ingatlanról!' ); ?> </span>
				
				<?php foreach ($getListingInfo['ListingImage'] as $key => $value): ?>

				<?php if($value['admin_deleted'] != 0): ?>	<!--Aktiv imageket huza ki. -->	

				<a class="fancybox" rel="group" href= <?php echo "/diploma/img/listing_uploads/" . $getListingInfo['ListingImage'][$key]['name'] ?> >
					<?php
						echo $this->Html->image( "listing_uploads/" . "thumb_" . 
							$getListingInfo['ListingImage'][$key]['name'],
							array(
								'alt' => 'Hirdetés,Albérlet'
							)
						);
					?>
				</a>

				<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>

	<!--Create google map,stzle external css-->
	<div id="google-map"></div>
	
	<?php
		/**
		*Read database lat,lng
		*Show the map, if the lat,lng exist in the database
		*/ 
		if( !empty($getListingInfo['Listing']['lat']) && !empty($getListingInfo['Listing']['lng']) )
		{
			echo $this->Form->input('Listing.lat',
				array(
					'type' => 'hidden',
					'value'=> $getListingInfo['Listing']['lat']
				)
			);
			echo $this->Form->input('Listing.lng',
				array(
					'type' => 'hidden',
					'value'=> $getListingInfo['Listing']['lng']
				)
			);
		}
	?>

	<script>
		/**
		*Google map marker
		*point specific coordinates
		*/
		function start()
		{
			var lat = document.getElementById("ListingLat").value;
			var lng = document.getElementById("ListingLng").value;

			var options = {
				center: new google.maps.LatLng(lat,lng),
				zoom: 16,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};

			var map = new google.maps.Map( document.getElementById("google-map"),options );

			var marker= new google.maps.Marker({
  				position: new google.maps.LatLng(lat,lng),
  				animation:google.maps.Animation.BOUNCE
  			});

			marker.setMap(map);
		}

		google.maps.event.addDomListener(window, 'load', start);

	</script>

	<!-- Kapcsolat a hirdetővel box -->
	<div class="contact-user">
		<fieldset>
			<span class="text-format" style="text-decoration:none;">
					<legend> <?php echo __( 'Kapcsolat a hirdetővel!' ); ?> </legend> 
			</span>

			<div class="contact-user-inner">	
				<?php 
					/**
					*Kapcsolat a hirdetővel, view része!!
					*/
					echo $this->Form->create( 'User', array(
						'inputDefaults' => array(
							'div' => array( 'class' => 'form-group' ),
							'class' => array( 'form-control' ),
						)
					) );
					
					echo $this->Form->input('fullname',
						array(
							'label' => false,
							'placeholder' => __('Az ön neve') 
						) );

					echo $this->Form->input('email',
						array(
							'label' => false,
							'placeholder' => __('E-mail cim') 
						) );

					echo $this->Form->input('description_hu',
						array(
							'label' => false,
							'type' => 'textarea',
							'placeholder' => __('Szöveg'),
							'value' => __('Kedves ' . $getListingInfo['User']['fullname'].'!' ) 
						) );

					echo $this->Form->input( 'phone',
						array(
							'label' => false,
							'placeholder' => __('Telefon') 
						) );

					echo $this->Recaptcha->display( array( 
						'recaptchaOptions' => array( 
							'theme' => 'clean' 
					) ) );

					echo '<div class="contact-user-button">';	
						echo $this->Form->button(__( 'Kapcsolat a hirdetővel' ),
							array(
								'class' => 'btn btn-primary' 
							) );

					echo '</div>';

					echo $this->Form->end();
				 ?>
			</div>
		</fieldset>
	</div>

	<?php endforeach; ?>
</div>