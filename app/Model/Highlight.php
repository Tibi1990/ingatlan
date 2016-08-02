<?php 

class Highlight extends AppModel{

	public $belongsTo = array(
		'Listing' => array(
			'className' => 'Listing'
		)
	);
	
}





 ?>