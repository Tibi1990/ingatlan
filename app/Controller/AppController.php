<?php

App::uses( 'Controller', 'Controller' );
App::uses( 'CakeEmail', 'Network/Email' );
App::uses( 'Sanitize', 'Utility' );
App::import( 'Vendor', 'ImageTool' );

class AppController extends Controller 
{
	/**
	*@Application Helpers
	*/	
	public $helpers = array(
		'Html',
		'Form',
		'Paginator',
		'Session',
		'Js',
		'Recaptcha.Recaptcha',
	);

	/**
	*@Application Components
	*/
	public $components = array(
		'Session',
		'Acl',
		'Paginator',
		'Cookie',
		'Recaptcha.Recaptcha',
		'RequestHandler',
		'DebugKit.Toolbar', 
		'Auth' => array(
			'logoutRedirect' => array(
				'controller' => 'users',
				'action' => 'index',
				'admin' => false	
			),
			'authorize' => array(
				'Controller'
			)
		)
	);

	/**
	*@This function is executed before every action in the controller.
	*/
	public function beforeFilter( $options = array() )
	{
		/**
		*@What actions non logged, users access to!!
		*/
		$this->Auth->allow(
			'index',
	 		'registration',
	 		'login',
	 		'logout',
	 		'activate',
	 		'forgot_password',
	 		'about',
	 		'display',
	 		'search_index'
 		);

		/**
		*@The user default auth error!
		*/
		$this->Auth->authError = __( 'Az oldal megtekintéséhez elsőnek be kell jelentkeznned!' );
 		$this->Auth->autoRedirect = false; //To stop it from automatically redirecting
	}

	/**
	*@Called after controller action logic,
	*but before the view is rendered. 
	*/
	public function beforeRender()
	{
		$this->set( 'currentUser', $this->Auth->user() );
	}

	/**
	*@isAuthorized function is mean what logged users acces to!!
	*Admin access everything.
	*/
	public function isAuthorized( $user ) 
	{
	    if ( isset( $user['role'] ) && $user['role'] === 'admin' ) 
	    {
	        return true;
	    }
	    return false;
    }

    /**
    *@Simple e-mail send!!
    */
	public function sendMail( $from = null, $to = null , $subject = null, $message = null )
	{
		$Email = new CakeEmail( 'gmail' );
		$Email->from( $from );
		$Email->to( $to );
		$Email->subject( $subject );
		$Email->emailFormat( 'html' );
		$Email->send( $message );
	}

	/**
	*@Forgott password e-mail send!!
	*/
	public function sendPasswordEmail( $user, $password, $userName ) 
	{
		$Email = new CakeEmail( 'gmail' );
		$Email->from( Configure::read( 'App.defaultEmail' ) ); //Who send e-mail
		$Email->to( $user['User']['email'] ); //Kinek send e-mail
		$Email->subject( __( 'Elfelejtett jelszó' ) ); //Subject
		$Email->template( 'forgot_password' ); //Which template use e-mail
		$Email->emailFormat( 'html' ); //Which e-mail format use
		$Email->viewVars(
			array(
					'user' => $user, //Pass variable to template
					'password' => $password, //Pass variable to template
					'userName' => $userName
				) 
			);

		$this->Session->setFlash(__( 'Az új jelszó el lett küldve a megadott e-mail címre!' ) );

		return $Email->send();
	}

	/**
	*@Contakt the listings owner(tulajdonos) e-mail across!!
	*/
	public function sendContactListingOvnerMail( $from = null, $to = null, $message = null, $listingUrl = null )
	{
		if( $this->Recaptcha->verify() )
		{
			$Email = new CakeEmail( 'gmail' );
			$Email->from( Configure::read( 'App.defaultEmail' ) ); //Kitől kapja az e-mailt
			$Email->to( array_values($to) ); //Kinek küldjük az e-mailt
			$Email->subject( __('Hirdetésre üzenete érkezett!') ); // Tárgy
			$Email->emailFormat( 'html' ); //Formátum
			$Email->template( 'contakt_listing_owner' ); //This e-mail template use.
			$Email->viewVars( array( 'message' => $message, 'url' => $listingUrl ) ); //Változot át paszolya e-mail templatnek.
			$Email->send(); //Send message

			$this->Session->setFlash(__( 'Üzenetedet sikeresen elküldtük a hirdetés feladójának!' ) );
		}
		else
		{
			/**
			*Default Recaptcha error.
			*/
			$this->Session->setFlash( $this->Recaptcha->error );
		}
	}

	/**
	*@Resize image function
	*/
	function resizeImage( $filename, $max_width, $max_height, $resizeDirectory )
	{
		list( $orig_width, $orig_height ) = getimagesize( $filename );

		$fileInfo = pathinfo( $filename );

		/**
		*width változohoz hozzá rendeli
		*a kép eredeti szálességet!
		*/
		$width = $orig_width;

		/*
		*height változohoz hozzá rendeli
		*a kép eredeti magasságát!
		*/
		$height = $orig_height;

		if ( $height > $max_height )
		{
			$width = ( $max_height / $height ) * $width;
			$height = $max_height;
		}

		if ( $width > $max_width )
		{
			$height = ( $max_width / $width ) * $height;
			$width = $max_width;
		}

		/**
		* Create a new true color image!!
		*Ezzel a függvénnyel egy új, üres képet hozhatunk létre.
		*Paraméterként meg kell adni a kép szélességét és magasságát pixelben,
		*majd visszaadja a resource-t.
		*/
		$image_p = imagecreatetruecolor( $width, $height );

		/**
		*Ezekkel a függvényekkel tudunk egy képet beolvasni.
		*Paraméterként a kép elérési útját kell megadnunk (ami egy karakterlánc)
		*/
		$image = imagecreatefromjpeg( $filename );

		/**
		*Átméretezést tudjuk végezni ezzel a fuggvenyel.
		*/
		imagecopyresampled( $image_p, $image, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height );

		/*
		*Ezekkel a függvényekkel tudjuk az alkotásunkat elmenteni.
		*Első paraméterként azt a resource-t kell neki átadnunk,
		*amit még a beolvasás során kaptunk, vagy amit az előző függvénnyel hoztunk létre,
		*a második paraméter pedig a kép elérési útja,
		*ahova menteni szeretnénk. Az elérési útban a kép nevét is meg kell adni,
		*kiterjesztéssel együtt.
		*/

		$createImage = imagejpeg( $image_p, $resizeDirectory , 100 );
		
		return $createImage;
	}

	/**
	*@Add to watermark to image(www.alberlet.rs)
	*/
	public function addWatermarkToImage( $imagePlace )
	{
		$stamp = imagecreatefrompng( IMAGES . 'watermark.png' ); //watermark elérési utvonala.
		$im = imagecreatefromjpeg( $imagePlace ); //Annak a képnek az elérési utvonala amitt feltöltünk,és ammire a watermark meggy.

		// Set the margins for the stamp and get the height/width of the stamp image
		$marge_right = 10;
		$marge_bottom = 10;

		$sx = imagesx( $stamp ); //Szélessége a watermarknak...
		$sy = imagesy( $stamp ); //Magassága a watermarknak...

		// Copy the stamp image onto our photo using the margin offsets and the photo 
		// width to calculate positioning of the stamp. 
		imagecopy( $im, $stamp, imagesx( $im ) - $sx - $marge_right, imagesy( $im ) - $sy - $marge_bottom, 0, 0, imagesx( $stamp ), imagesy( $stamp ) );

		// Output and free memory
		header( 'Content-type: image/png' );
		imagepng( $im, $imagePlace, 9 );
		imagedestroy( $im );
	}
}

?>
