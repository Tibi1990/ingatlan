
<?php
	/**
	*Index listing box style
	*Főoldali hirdetéseket huzza ki.
	*KIEMELT HIRDETÉSEKET HUZZA KI A FŐOLDALRA
	*/
	foreach( $searchRequests as $searchRequest ):

	$url = 'hirdetesmegtekintes/' . $searchRequest['Listing']['id'];

	echo '<div class="box">';
		echo '<div class="inner-box-top">';
			echo '<span class="box-city">' . '<a href="' . $url . '">' . $searchRequest['Listing']['city'] . '</a>' . '</span>';
			
			echo '<br />';

			echo '<b>' . $searchRequest['Listing']['address'] . '</b>';
			
		echo '</div>';

		echo $this->Html->image( "listing_uploads/" . "thumb_" . $searchRequest['ListingImage'][0]['name'], array(
			'alt' => __( 'Hirdetés fényképe' ),
			'title' => __('Kiemelt hirdetés'),
			'url' => 'listings_proces/' . $searchRequest['Listing']['id']
		) );

		echo '<br>';

		echo '<div class="inner-box-bottom">';
			echo '<b>' . $searchRequest['Listing']['rent_price'] . ' EUR' . '</b>'.'<br />';
			echo '<small class="box-size-room-style">' . $searchRequest['Listing']['size'] . 'm<sup>2</sup> -' . $searchRequest['Listing']['numbers_room'] . ' szoba' . '</small>';
		echo '</div>';

	echo '</div>';

	/**
	*$searchRequest foreach vége!!
	*/
	endforeach;
?>

