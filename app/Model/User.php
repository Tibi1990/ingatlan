<?php

App::uses( 'AuthComponent', 'Controller/Component' );

class User extends AppModel
{
	public $validationDomain = 'validation';
	public $primaryKey = 'id';

	public $hasOne = array(
		'Listing' => array(
			'className' => 'Listing'
		)
	);

	public $hasMany = array(
		'ListingImage' => array(
			'className' => 'ListingImage'
		)
	);
	
	/**
	*This function run before save proces.
	*Hash the user password.
	*/	
	public function beforeSave( $options = array() )
	{
		if( isset( $this->data['User']['password'] ) )
		{
			$this->data['User']['password'] = AuthComponent::password( $this->data['User']['password'] );
			$this->data['User']['password_confirmation'] = AuthComponent::password( $this->data['User']['password_confirmation'] );
		}
	}

	public function __construct()
	{
		parent::__construct();

		$this->validate = array(
		'username' => array(
			'Username notEmpty' => array(
				'rule' => array( 'notEmpty', 'alphaNumeric' ),
				'allowEmpty' => false,
				'message' => __( 'A felhasználonév mező nem maradhat üresen' )
			),
			'The username is must unique' => array(
				'rule' => array( 'isUnique', 'username' ),
				'on' => 'update',
				'message' => __( 'A felhasználonév már létezik,kérlek adj meg egy másik felhasználonevet!' )
			),
			'The username field must be contain 5-characters' => array(
				'rule' => array( 'minLength', 5 ),
				'message' => __( 'Felhasználonévnek minimum 5-karaktert meg kell adni!')
			)
		),
		'fullname' => array(
			'Full name field cannot be empty' => array(
				'rule' => array( 'notEmpty', 'alphaNumeric' ),
				'allowEmpty' => false,
				'message' => __( 'Kérlek add meg a teljes neved!' )
			),
			'Minimum number of letters' => array(
				'rule' => array( 'minLength', 5 ),
				'message' => __( 'Teljes névnek minimum 5-karaktert meg kell adni!' )
			)
		),
		'password' => array(
			'Password field cannot be empty' => array(			
				'rule' => array( 'notEmpty' ),
				'allowEmpty' => false,
				'message' => __( 'Kérlek add meg a jelszavad' )
			)
		),	
		'password_confirmation' => array(
			'Password confirmation notEmpty' => array(
				'rule' => array( 'notEmpty' ),
				'allowEmpty' => false,
				'message' => __( 'Kérlek add meg ismét a jelszavad' ),
			),
			'password equal' => array(
				'rule' => array( 'validate_passwords' ),
				'allowEmpty' => false,
				'message' => __( 'A két jelszó nem egyezik meg!' )
			)
		),
		'email' => array(
			'The email not be empty' => array(
				'rule' => array( 'notEmpty' ),
				'allowEmpty' => false,
				'message' => __( 'Email mező nem maradhat üresen!' )
			),
			'The email must be isUnique' => array(
				'rule' => array( 'isUnique', 'email' ),
				'message' => __( 'A megadott email cím már létezik az adatbázisunkban,kérlek adj meg egy másik email címet!' )
			)
		),
		/*'phone' => array(
			'The phone not be empty' => array(
				'rule' => array( 'notEmpty' ),
				'allowEmpty' => false,
				'message' => __( 'Telefonszám mező nem maradhat üresen!' )
			),
			'The phone must be isUnique' => array(
				'rule' => array( 'isUnique', 'phone' ),
				'on' => 'update',
				'message' => __( 'A megadott telefonszám már létezik az adatbázisunkban,kérlek adj meg egy másik telefonszámot!' )
			),
			'The phone must be numeric' => array(
				'rule' => array( 'phone', null, 'us' ),
				'message' => __( 'Telefonszámnak csak számokat lehet megadni !' )
			)
		),*/
		'user_photo' => array(
			'Image rules' => array(
				'rule' => array( 'notEmpty' ),
				'message' => __( 'Kérlek töltsd fel magadrol a kedvenc képedet!' ),
				'allowEmpty' => false
			)
		)
	);}
	
	/**
	*Check password confirmation.
	*/
	public function validate_passwords()
	{
 		return $this->data[$this->alias]['password'] === $this->data[$this->alias]['password_confirmation'];
	}

	/**
	*Forgot password proces
	*/
	public function getActivationHash()
	{
		if( !isset( $this->id ) )
		{
			return false;
		}
		return substr( Security::hash( Configure::read( 'Security.salt' ) . $this->field( 'created' ) . date('Ymd') ), 0, 8 );
	}

	/**
	*Forgot password proces,
	*create temp password
	*/
	public function createTempPassword( $len )
	{	
		$pass = '';
		$lchar = 0;
		$char = 0;

	   for( $i = 0; $i < $len; $i++ ) 
	   {
		 while( $char == $lchar ) 
		 {
		   $char = rand( 48, 109 );
		   if( $char > 57 ) $char += 7;
		   if( $char > 90 ) $char += 6;
		 }

		$pass.= chr( $char );
		$lchar = $char;
		
		}
	   return $pass;
	}
}

?>