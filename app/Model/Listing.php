<?php
App::uses( 'AppModel', 'Model' );

class Listing extends AppModel{	
	
	public $primaryKey = 'id';
	
	public $belongsTo = array(
		'User' => array(
			'className' => 'User'
		)
	);

	public $hasMany = array(
		'ListingImage' => array(
			'className' => 'ListingImage'
		)
	);


	public function __construct()
	{
		parent::__construct();

		$this->validate = array(
		'city' => array(
			'City notEmpty' => array(
				'rule' => array( 'alphaNumeric' ),
				'allowEmpty' => true,
				'message' => __( 'Kérem válasszon a listából' )
			)
		),
		'status_rent' => array( //Ingatlan eldó vagy kiadó.Select tipusu.
			'Eladó,Kiadó' => array(
				'rule' => array( 'alphaNumeric' ),
				'allowEmpty' => false,
				'message' => __( 'Kérem válasszon a listából' )
			)
		),
		'address' => array(
			'Address field cannot be empty' => array(
				'rule' => array( 'notEmpty' ),
				'allowEmpty' => false,
				'message' => __( 'Kérlek add meg a pontos címedet!' )
			),
			'Minimum number of letters' => array(
				'rule' => array( 'minLength', '5' ),
				'message' => __( 'Minimum 5-karaktert meg kell adni!' )
			)
		),
		'status' => array( //status - LAKAS,HAZ
			'Status field cannot be empty' => array(			
				'rule' => array( 'notEmpty' ),
				'allowEmpty' => false,
				'message' => __( 'Kérem válasszon a listából' )
			)
		),	
		/*'state' => array( //state - Ingatlan állapota butorozot,nem butorozot
			'State notEmpty' => array(
				'rule' => array( 'alphaNumeric' ),
				'allowEmpty' => true,
			)
		),*/
		'size' => array( //Alapterulet az ingatlanal négyzetméter-ben
			'The size must be a number' => array(
				'rule' => 'numeric',
				'allowEmpty' => true,
				'message' => __( 'Csak számokat lehet megadni!' ),
			)
		),
		'numbers_room' => array(
			'Room numbers' => array(
				'rule' => array( 'notEmpty' ),
				'message' => __( 'Kérem válasszon a listából' )
			)
		),
		'heating' => array( //futes
			'The heating not be empty' => array(
				'rule' => array( 'notEmpty' ),
				'allowEmpty' => false,
				'message' => __( 'Kérem válasszon a listából' )
			)
		),
		'parking' => array(
			'The parking not be empty' => array(
				'rule' => array( 'alphaNumeric' ),
				'allowEmpty' => true,
				'message' => __( 'Kérem válasszon a listából!' )
			)
		),
		'rent_price' => array( //Berleti dij
			'Rent price' => array(
				'rule' => array( 'notEmpty' ),
				'allowEmpty' => true,
				'message' => __( 'Mező nem maradhat üresen!' )
			),
			'The size must be a number' => array(
				'rule' => array( 'numeric' ),
				'message' => __( 'Csak számokat lehet megadni!' )
			)
		),
		/*'deposit' => array( //kaukciohoz lehet h nem kellene validalni
			'Deposit' => array(
				'rule' => array( 'alphaNumeric' ),
				'allowEmpty' => true,
				'message' => __( 'Kérem válasszon a listából!' )
			)
		),*/
		'description_hu' => array(
			'Description not be empty' => array(
				'rule' => array( 'notEmpty' ),
				'allowEmpty' => false,
				'message' => __( 'Leírás nem maradhat üresen!' )
			)
		));
	}
}

?>