<!--Index main page, short-search -->
<div class="search-box"> 
	<?php 
		echo $this->Form->create( 'Listing', array( 'action' => 'search_index' ) );

		$options = array(
			'Elado' => 'Eladó',
			'Kiado' => 'Kiadó'
		);

		$attributes = array(
			'legend' => false, 
			'checked' => true
		);
		
		/**
		*@params Fieldname, options, attributes
		*/
		echo $this->Form->radio( 'Listing.status_rent', $options, $attributes );

		$options = array(
			'Lakás' => 'Lakás',
			'Ház' => 'Ház'
		);

		$attributes = array( 'empty' => false );
		echo $this->Form->select( 'Listing.status', $options, $attributes );

		$options = array(
			'div' => false,
			'label' => 'Város',
			'placeholder' => __( 'Hol keress ingatlant?' ) 
		);

		echo $this->Form->input( 'Listing.city', $options );

		$options = array(
			'div' => false,
			'label' => __( 'Ár' ), 
			'placeholder' => __( 'Euróban' )
		);

		echo $this->Form->input( 'Listing.rent_price', $options );

		$options = array(
			'div' => false,
			'label' => __( 'Alapterület' ), 
			'placeholder' => __( 'Négyzetméterben' )
		);

		echo $this->Form->input( 'Listing.size', $options );	

		echo $this->Form->button(__( 'Keresés' ),
			array(
				'class' => 'main-page-search'
		) );

		echo $this->Form->end();
	 ?>
</div>