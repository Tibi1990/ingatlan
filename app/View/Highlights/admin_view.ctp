<div class="users view">
	<dl>
		<dt>
			<?php echo __( 'Azonosító' ); ?>
		</dt>

		<dd>
			<?php echo h( $listing['Listing']['id'] ); ?>
			&nbsp;
		</dd>

		<dt>
			<?php echo __( 'Város' ); ?>
		</dt>

		<dd>
			<?php echo h( $listing['Listing']['city'] ); ?>
			&nbsp;
		</dd>

		<dt>
			<?php echo __( 'Ingatlan tipusa' ); ?>
		</dt>

		<dd>
			<?php echo h( $listing['Listing']['status_rent'] ); ?>
			&nbsp;
		</dd>

		<dt>
			<?php echo __( 'Ingatlan állapota' ); ?>
		</dt>

		<dd>
			<?php echo h( $listing['Listing']['status'] ); ?>
			&nbsp;
		</dd>

		<dt>
			<?php echo __( 'Ingatlan mérete' ); ?>
		</dt>

		<dd>
			<?php echo h( $listing['Listing']['size'] ); ?>
			&nbsp;
		</dd>

		<dt>
			<?php echo __( 'Szobák száma' ); ?>
		</dt>

		<dd>
			<?php echo h( $listing['Listing']['numbers_room'] ); ?>
			&nbsp;
		</dd>

		<dt>
			<?php echo __( 'Fűtés tipusa' ); ?>
		</dt>

		<dd>
			<?php echo h( $listing['Listing']['heating'] ); ?>
			&nbsp;
		</dd>

		<dt>
			<?php echo __( 'Parkolás tipusa' ); ?>
		</dt>

		<dd>
			<?php echo h( $listing['Listing']['parking'] ); ?>
			&nbsp;
		</dd>


		<dt>
			<?php echo __( 'Bérleti dij' ); ?>
		</dt>

		<dd>
			<?php echo h( $listing['Listing']['rent_price'] ); ?>
			&nbsp;
		</dd>

		<dt>
			<?php echo __( 'Deposit' ); ?>
		</dt>

		<dd>
			<?php echo h( $listing['Listing']['deposit'] ); ?>
			&nbsp;
		</dd>

		<dt>
			<?php echo __( 'Ingatlan leírása' ); ?>
		</dt>

		<dd>
			<?php echo h( $listing['Listing']['description_hu'] ); ?>
			&nbsp;
		</dd>
		
		<dt>
			<?php echo __( 'Kiemelt hirdetés' ); ?>
		</dt>

		<dd>
			<?php echo h( $listing['Listing']['highlight'] ); ?>
			&nbsp;
		</dd>
		
		<dt>
			<?php echo __( 'Admin jováhagyva' ); ?>
		</dt>

		<dd>
			<?php echo h( $listing['Listing']['admin_aktiv'] ); ?>
			&nbsp;
		</dd>

		<dt>
			<?php echo __( 'Hirdetés létrehozva' ); ?>
		</dt>

		<dd>
			<?php echo h( $listing['Listing']['created'] ); ?>
			&nbsp;
		</dd>

		<dt>
			<?php echo __( 'Hirdetés módositva' ); ?>
		</dt>

		<dd>
			<?php echo h( $listing['Listing']['modified'] ); ?>
			&nbsp;
		</dd>
	</dl>

	<!--HIRDETES KEPEIT AZ ADMINBA BE RAKNI IMAGE GALLERY -->
	<div class="admin-listing-image-wrapper">
		<?php		
			//Hirdetés megtekintése image gallery
			foreach($listing['ListingImage'] as $image):
		?>	
		<div class="admin-image-box">
			<a class="fancybox" rel="group" href= <?php echo "/diploma/img/listing_uploads/" . $image['name'] ?> >
				<?php
					echo $this->Html->image('listing_uploads/' .  "thumb_" . $image['name'],
						array(
							'alt' => 'Albérlet,Hirdetés',
							'class' => 'admin-listing-image' //Image class style
						)
					);
				?>
			</a>
		</div>
			
		<?php endforeach; ?>	 
	
	</div>

</div><!--End the list -->

<!--Slider button -->
<div class="actions">
	<ul>
		<li>
			<?php
				echo $this->Html->link(__( 'Hirdetés szerkesztése' ),array(
					'action' => 'edit',
				 	$listing['Listing']['id'] 
			 	) );
	 		 ?> 
		</li>

		<li>
			<?php 
				echo $this->Form->postLink(__( 'Hirdetés törlése' ),array(
					'action' => 'delete',
				 	$listing['Listing']['id'] ),
				  	null, __( 'Biztos le akkarod törölni a felhasználot?', $listing['Listing']['id'] 
		  		) ); 
			 ?> 
		</li>

		<li>
			<?php 
				echo $this->Html->link(__( 'Hirdetés listázása' ),array(
					'action' => 'index' 
			) ); 
			?>
		</li>
	</ul>
</div>
