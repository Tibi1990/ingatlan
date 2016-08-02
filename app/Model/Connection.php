<?php

class Connection extends AppModel
{
	public $validate = array(
		'name' => array(
			'rule' => array( 'notEmpty', 'alphaNumeric' ),
		),
		'subject' => array(
			'rule' => array( 'notEmpty' ),
		),
		'email' => array(
			'rule' => array( 'email','notEmpty' )
		),
		'description' => array(
			'rule' => array( 'notEmpty' )
		)
	);
}

?>