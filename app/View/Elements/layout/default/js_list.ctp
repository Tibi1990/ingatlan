<?php 	
	echo $this->fetch( 'script' );

	echo $this->Html->script( 'jquery/jquery-2.1.1.min.js' ); //JQUERY MIN LIBARY!
	echo $this->Html->script( 'jqueryui/jquery-ui.min.js' ); //JQUERY UI MIN LIBARY!
	echo $this->Html->script( 'bootstrap/bootstrap.min.js' ); //BOOTSTRAP MIN LIBARY!
	echo $this->Html->script( 'default/default.js' ); //MY OWN JS!
	echo $this->Html->script( 'fancybox/jquery.fancybox.pack.js' ); //JQUERY FANCYBOX JS!

	/*******************************************************************************************
	*Google maps script
	********************************************************************************************
	********************************************************************************************/
	
	/**
	*Google external script, search places
	*/	
	echo $this->Html->script( "https://maps.googleapis.com/maps/api/js?libraries=places");

	/**
	*Google mas js code.
	*/
	echo $this->Html->script( "googlemaps/map.js");

?>
