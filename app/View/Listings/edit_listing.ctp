<!--Listing edit USE listing-add CSS-->
<div class="listing-add">  
	<fieldset>
		<legend class="website-color-edit-page">
			<?php echo __( 'Hirdetés szerkesztése' ); ?>
		</legend>

		<?php
			echo $this->Form->create( 'Listing', array(
				'action' => 'editListing',
				'type' => 'file'
			) );

			echo $this->Form->input( 'user_id', array(
				'type' => 'hidden',
				'value' => $this->Session->read( 'Auth.User.id' )
			));

			echo $this->Form->input( 'Listing.city', array(
				'type' => 'select',
				'options' => array(
			  		'Szabadka' => 'Szabadka',
				  	'Kishegyes' => 'Kishegyes',
				  	'Feketics' => 'Feketics',
				  	'Topolya' => 'Topolya' 
				),
				'label' => __( 'Város' ),
				'empty' => __( '--Válasz--' )
			) );

			echo '<hr />';
			
			echo $this->Form->input( 'Listing.status_rent', array( //Elado,Kiado
				'type' => 'select',
				'label' => __( 'Ingatlan' ),
				'options' => array(
					 'Eladó' => 'Eladó',
					 'Kiadó' => 'Kiadó' 
				 ),
				'empty' => __( '--Válasz--' )
			) );

			echo '<hr />';

			echo $this->Form->input( 'Listing.address', array(
				'placeholder' => __( 'Minimum 2 karakter!' ),
				'label' => __( 'Ingatlan címe' ),
				'empty' => __( '--Válasz--' ),
				'placeholder' => __( 'Csak számokat lehet megadni!' )
			) );

			echo '<hr />';

			echo $this->Form->input( 'Listing.status', array( //Lakas,Haz
				'type' => 'select',
				'label' => __( 'Ingatlan típusa' ),
				'options' => array(
					 'Lakás' => 'Lakás',
					 'Ház' => 'Ház' 
				 ),
				'empty' => __( '--Válasz--' )
			) );

			echo '<hr />';

			echo $this->Form->input( 'Listing.state', array(
				'type' => 'select',
				'label' => __( 'Ingatlan állapota' ),
				'options' => array(
					'Butorozot' => 'Butorozot',
					'Nem butorozot' => 'Nem butorozot'  
				),
				'empty' => __( '--Válasz--' )
			) );

			echo '<hr />';

			echo $this->Form->input( 'Listing.size', array(
				'label' => __( 'Ingatlan mérete' ),
				'empty' => __( '--Válasz--' ),
				'placeholder' => __( 'Csak számokat lehet megadni!' )
			) );

			echo '<hr />';

			echo $this->Form->input( 'Listing.numbers_room', array(
				'type' => 'select',
				'label' => __( 'Szobák száma' ),
				'options' => array(
					1 => 1,
					2 => 2,
					3 => 3,
					4 => 4,
					5 => 5,
					6 => 6,
					7 => 7,
					8 => 8,
					9 => 9
			 	),
				'empty' => __( '--Válasz--' )
			) );

			echo '<hr />';

			echo $this->Form->input( 'Listing.heating', array(
				'type' => 'select',
				'label' => __( 'Fűtés' ),
				'options' => array(
					'Kazán' => 'Kazán',
					'Villany' => 'Villany' 
				),
				'empty' => __( '--Válasz--' )
			) );

			echo '<hr />';

			echo $this->Form->input( 'Listing.parking', array(
				'type' => 'select',
				'label' => __( 'Parkolás' ),
				'options' => array(
					'Utcai' => 'Utcai',
					'Mélygarázs' => 'Mélygarázs'
				),
				'empty' => __( '--Válasz--' )
			) );

			echo '<hr />';

			echo $this->Form->input( 'Listing.rent_price', array(
				'type' => 'text',
				'label' => __( 'Havi bérleti díj' ),
				'placeholder' => __( 'Csak számokat lehet megadni!' )
			) );

			echo '<hr />';

			echo $this->Form->input( 'Listing.deposit', array(
				'type' => 'select',
				'label' => __( 'Kaukció' ),
				'options' => array(
					'Egy honap' => 'Egy hónap',
					'Két honap' => 'Két hónap',
					'Három honap' => 'Három hónap'
				),
				'empty' => __( '--Válasz--' )
			) );

			echo '<hr />';

			echo $this->Form->input( 'Listing.description_hu', array(
				'type' => 'textarea',
				'escape' => false,
				'cols' => '100',
				'label' => __( 'Leírás' ),
				'placeholder' => __( 'Leírás nem maradhat üresen!' )
			) );

			echo '<hr />';

			echo $this->Form->input( 'ListingImage.name', array(
				'type' => 'file',
				'label' => __( 'Töltsd fel az ingatlanodról a kedvenc képeidet!' )
			));
		?>
			
		<!-- Hirdeto kepeit huzzuk ki a boxba -->
		<!-- thumb_ resizolt prefix -->
		<!-- Ha ra kattint a kepre nagyobba jelenyen meg -->
		<div class="edit-listing-photo">
			<span class="edit-listing-photo-text">
				<?php echo __('Hirdetés képei'); ?>
			</span>
			
			<?php foreach($listingImages as $images): ?>
			
			<a class="fancybox" rel="group" href=<?php echo "/diploma/img/listing_uploads/" . $images['ListingImage']['name'] ?> >
				<?php
					echo $this->Html->image(
						"listing_uploads/" . $images['ListingImage']['name'],
						array(
							"alt" => __( "Hirdetés" )
						)
					);
				?>
			</a>

			<?php endforeach; ?>

			<div class="clear"></div>
		</div>


		<?php
			echo '<hr />';

			echo "<span style='margin-left:14px;'>";
				echo $this->Form->button(__( 'Hirdetés szerkesztése' ),
					array(
						'class' => 'btn btn-primary'	
					) 
				);
			echo "</span>";

			echo $this->Form->end();
		?>
	</fieldset> 
</div>