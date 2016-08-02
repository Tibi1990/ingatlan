<div id="mainsearch" style="display:none;">
	<?php
		echo $this->element('search/mainsearch');
	?>
</div>
<!-- LISTING ADD(HIRDETÉSFELADÁS) -->
<div class="listing-add">
	<fieldset>
		<legend class="website-color-orange">
			<?php echo __( 'Hirdetésfeladás' ); ?>
		</legend>
		
		<?php
			echo $this->Form->create( 'Listing', array(
				'action' => 'listingAdd',
				'type' => 'file'
			) );
			
			echo $this->Form->input('user_id', array(
				'type' => 'hidden',
				'value' => $this->Session->read('Auth.User.id')
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
				'label' => __( 'Ingatlan címe' ),
				'empty' => __( '--Válasz--' ),
				'placeholder' => __( 'Ingatlan címe, házszámmal együtt' )
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
					'Butorozott' => 'Bútorozott',
					'Nem butorozott' => 'Nem bútorozott'  
				),
				'empty' => __( '--Válasz--' )
			) );

			echo '<hr />';

			echo $this->Form->input( 'Listing.size', array(
				'label' => __( 'Ingatlan mérete' ),
				'empty' => __( '--Válasz--' ),
				'placeholder' => __( 'Ingatlan mérete négyzetméterben' )
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
					'Villany' => 'Villany',
					'Egyéb' => 'Egyéb' 
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
				'placeholder' => __( 'Euróban' )
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

			/***
			*MULTIPLE IMAGE UPLOAD!!
			*/
			echo $this->Form->input( 'ListingImage.name.', array(
				'type' => 'file',
				'multiple',
				'label' => __( 'Töltsd fel az ingatlanodról a kedvenc képeidet! (Maximum hármat lehet)' )
			));
		
			echo '<hr />';
		?>
		<!-- Google maps html code.Hirdetésfeladás -->
		 <div>
			  <input id="pac-input" class="controls" type="text" placeholder="Írja be az ingatlan pontos címét">
		</div>
		<!-- Google map render map-canvas div -->
		<div id="map-canvas"></div>
		
		<?php
			echo "<span style='margin-left:14px;'>";
				echo $this->Form->button(__( 'Hirdetés feladása' ),
					array(
						'class' => 'btn btn-primary',
						'onclick' => 'mapValidator()'
					) 
				);
			echo "</span>";

			/**
			*Google maps save
			*lat,lng hidden field.
			*/
			echo $this->Form->input('Listing.lat', array( 'type' => 'hidden' ) );
			echo $this->Form->input('Listing.lng', array( 'type' => 'hidden' ) );

			echo $this->Form->end();
		?>
	</fieldset> 
</div>