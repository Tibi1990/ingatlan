<?php

App::uses( 'AppController', 'Controller' );
App::uses( 'CakeEmail', 'Network/Email' );

class UsersController extends AppController 
{
	public function beforeFilter( $options = array() )
	{
		/**
		*Call parent beforeFilter()
		*/
		parent::beforeFilter();

		/**
		*Non logged access this functions.
		*/
		$this->Auth->allow(
			'userProfile',
			'profile_edit',
			'listings_proces',
			'conntactListingOwner'
		);

		/**
		*If the user stay in a hompage,then delete the session
		*/
		if($this->params['controller'] == 'users' && $this->params['action'] == 'index' )
		{
			$this->Session->destroy();
		}
	}

	/**
	*Admin functions
	*Get the users the main page.
	*/
	public function admin_index() 
	{
		$this->layout = 'admin'; //This function use this layout
		$this->set( 'title_for_layout', __( 'Admin' ) );

		$this->User->recursive = 0;

		$this->Paginator->settings = array(
			'conditions' => array(
				'User.deleted <>' => 1
			),
			'contain' => false //Because one user, multiple time show the admin panel
		);

		$users = $this->Paginator->paginate('User');

		$this->set( 'users', $users );
	}

	/**
	*Admin view the user
	*/
	public function admin_view( $id = null ) 
	{
		$this->layout = 'admin'; //This function use this layout
		$this->set( 'title_for_layout', __('Admin') );

		if ( !$this->User->exists( $id ) ) 
		{
			throw new NotFoundException(__( 'Ismeretlen felhasználó!' ) );
		}

		$options = array(
			'conditions' => array(
				$this->User->primaryKey => $id
			),
			'contain' => false //Only user model use conditions.
		);

		$this->set( 'user', $this->User->find( 'first', $options ) );
	}

	/**
	*Admin add function.
	*/
	public function admin_add() 
	{
		$this->layout = 'admin';
		$this->set( 'title_for_layout', __( 'Admin' ) );

		if ( $this->request->is( 'post' ) ) 
		{
			$this->User->create();

			if ( $this->User->save( $this->request->data ) ) 
			{
				$this->Session->setFlash(__( 'Felhasználó sikeres létrehozása!' ) );

				$this->redirect( array( 
					'controller' => 'users',
					'action' => 'index',
					'admin' => true 
				));
			}
		}
	}

	/**
	*Admin users-edit function.
	*/
	public function admin_edit( $id = null ) 
	{
		$this->layout = 'admin';
		$this->set( 'title_for_layout', __( 'Admin' ) );

		if ( !$this->User->exists( $id ) ) 
		{
			throw new NotFoundException(__( 'Ismeretlen felhasználó!' ) );
		}

		if ( $this->request->is( array( 'post', 'put' ) ) ) 
		{
			if ( $this->User->save( $this->request->data ) ) 
			{
				$this->Session->setFlash(__( 'Felhasználó sikeresen lett módosítva!' ) );

				return $this->redirect( array( 
					'controller' => 'users',
					'action' => 'admin_index' 
				) );
			}
		} 
		else 
		{
			$options = array( 'conditions' => array( 'User.' . $this->User->primaryKey => $id ) );
			$this->request->data = $this->User->find( 'first', $options );
		}
	}

	/**
	*Admin delete function.
	*/
	public function admin_delete( $id = null ) 
	{
		$this->layout = 'admin';
		$this->set( 'title_for_layout', __( 'Admin' ) );

		$this->User->id = $id;

		if ( !$this->User->exists() ) 
		{
			throw new NotFoundException(__( 'Ismeretlen felhasználó!' ) );
		}

		$this->request->onlyAllow( 'post', 'delete' );

		if ( $this->User->saveField( 'deleted', 1 ) ) 
		{
			$this->Session->setFlash(__( 'A felhasználó sikeresen törölve lett!' ) );

			return $this->redirect( array( 
				'controller' => 'users',
				'action' => 'admin_index' 
			) );
		}
		else 
		{
			return $this->Session->setFlash(__( 'A felhasználot nem sikerült törölni!' ) );
		}
	}

	public function admin_show_delete()
	{
		$this->layout = 'admin';
		$this->set( 'title_for_layout', __( 'Admin' ) );

		$users = $this->Paginator->paginate(
			'User',
			array( 'User.deleted <>' => 0) //Csak az TÖRÖLT hirdetéseket huzza ki.
		);

		$this->set( 'users', $users );
	}

	/**
	*Activation deleted users
	*/
	public function admin_delete_activation( $id = null ) 
	{
		$this->layout = 'admin';
		$this->set( 'title_for_layout', __( 'Admin' ) );

		$this->User->id = $id;

		if ( !$this->User->exists() ) 
		{
			throw new NotFoundException(__( 'Ismeretlen felhasználó!' ) );
		}

		if ( $this->User->saveField( 'deleted', 0 ) ) 
		{
			$this->Session->setFlash(__( 'Törölt hirdetés sikeresen vissza állitva!!' ) );

			return $this->redirect( array( 
				'controller' => 'users',
				'action' => 'admin_index' 
			) );
		}
		else 
		{
			return $this->Session->setFlash(__( 'Törölt hirdetés nem sikerült vissza állitva!!' ) );
		}
	}

	/**
	*Admin login function
	*/
	public function admin_login()
	{
		$this->layout = 'admin';
		$this->set( 'title_for_layout', __( 'Admin' ) );

		if( $this->Auth->login() )
		{
			return $this->redirect( array(
				'controller' => 'users',
				'action' => 'index',
				'admin' => true
			) );
		}
	}

	/**
	*Admin logout function
	*/
	public function admin_logout()
	{
		$this->layout = 'admin';

		/**
		*Delete the session
		*/
 		$this->redirect( $this->Auth->logout() );
	}


/*********************USERS FUNCTIONS**********************/
/**********************************************************/

	/**
	*Get users listings, the main page!!
	*Show listings the main page(FŐOLDAL).
	*MAX LISTING SHOW THE MAIN PAGE-10.
	*/
	public function index()
	{
		/**
		*The action, wich layout use.
		*/			
		$this->layout = 'default';
		$this->set( 'title_for_layout', 'Albérlet' );

		$searchRequests = $this->User->Listing->find( 'all', array(
			'conditions' => array(
				'Listing.deleted <>' => 1, //Deleted listings NOT show the main page.
				'Listing.highlight' => 1 //Akkor huzzuk ki a hirdetést ha ki van emelve.
			),
			'fields' => array(
				'Listing.id',
				'Listing.city',
				'Listing.address',
				'Listing.rent_price',
				'Listing.size',
				'Listing.numbers_room',
				'Listing.deleted'
			),
			'order' => array(
				'Listing.created' => 'desc' //Mindig a legujabb hirdetést huzza ki.
			),
			'limit' => 10 //Max 10-hirdetést huzz ki a főoldalra.
		) );


		/**
		*Paszolya a viewnak a search keresés eredményeit.
		*/
		$this->set( compact( 'searchRequests' ) );
	}

	/**
	*User registration page.
	*/
	public function registration()
	{
		$this->layout = 'default';
		$this->set( 'title_for_layout', __('Regisztráció') );
		
		if( $this->request->is( 'post' ) && !empty( $this->request->data ) )
		{
			if( $this->Recaptcha->verify() )
			{
				$imageName = strtolower( $this->request->data['User']['user_photo']['name'] );
				$imageExtension = pathinfo( $imageName, PATHINFO_EXTENSION );
				$allowedExtension = strtolower( $imageExtension );
				$imageTmp = $this->request->data['User']['user_photo']['tmp_name'];
				$imageSize = $this->request->data['User']['user_photo']['size'];

				if( $allowedExtension != 'jpeg' && $allowedExtension != 'png' && $allowedExtension != 'jpg' && $allowedExtension != 'gif' )
				{
					return $this->Session->setFlash(__( 'Csak (jpeg,jpg,png,gif) kiterjesztésü képeket szabad feltölteni!' ) );
				}
				
				if( $imageSize >= 2049449 ) // 2MB
				{
					return $this->Session->setFlash(__( 'Két megabájtnál nem lehet nagyobb a kép!' ) );
				}

				$imagePlace = WWW_ROOT . 'img/users_photos/' . $imageName;
				$fileInfo = pathinfo( $imagePlace );
				$resizeImageDirectory = WWW_ROOT . 'img/users_photos/' . 'thumb_' . $fileInfo['basename'];

				if( move_uploaded_file( $imageTmp, $imagePlace ) );
				{
					$resizePhoto = $this->resizeImage( $imagePlace, 100, 100, $resizeImageDirectory );
				}

				$this->request->data['User']['user_photo'] = $imageName;

				if( $this->User->save( $this->request->data ) )
				{
					$this->User->saveField( 'email_token', $this->User->getActivationHash() );
					
					$this->sendActivationEmail( $this->User->getLastInsertID() );


					return $this->redirect( array( 
						'action' => 'index'
					) );

					$this->Session->setFlash(__( 'Sikeres regisztráció! A megadott e-mail címre elküldtünk
					 a megerösitő e-mailt!<br />Kérlek igazold vissza,és jelentkezz be!' ) );
				}
				else
				{
					$this->Session->setFlash(__( 'Sikertelen regisztráció!' ) );
				}	
			}
			else
			{
				/**
				*Default recaptcha error.
				*/
				$this->Session->setFlash( $this->Recaptcha->error );
			}
		}
	}

	/**
	*User login page.
	*/
	public function login()
	{
		$this->layout = 'default';
		$this->set( 'title_for_layout', __( 'Bejelentkezés' ) );

		if( $this->request->is( 'post' ) )
		{
			if( $this->Auth->login() )
			{
				$this->redirect( array(
					'controller' => 'listings',
					'action' => 'index',
					'admin' => false
				) );
			}
			else
			{
				$this->Session->setFlash(__( 'Felhasználonév vagy a jelszó kombinációja nem jó!' ) );
			}
		}
	}

	/**
	*Current user profile!
	*/
	public function userProfile()
	{
		$this->set( 'title_for_layout', __( 'Profil' ) );
		$this->layout ='after_login';

		/**
		*Read the session the current user information.
		*/
		$user = $this->Auth->user( 'id' );
		
		/**
		*Find the logged user.
		*/
		$userInfo = $this->User->find( 'all', array(
			'conditions' => array( 'id' => $user ),
			'contain' => false
		));

		/**
		*Count user activ listings,
		*the show the user-profile table
		*/
		$userActivListingCount = $this->User->find('count',array(
			'conditions' => array(
				'User.id' => $user,
				'Listing.admin_aktiv' => 1
			)
		));

		/**
		*Count user activ listings,
		*the show the user-profile table
		*/
		$userInactivListingCount = $this->User->find('count',array(
			'conditions' => array(
				'User.id' => $user,
				'Listing.admin_aktiv' => 0
			)
		));

		$this->loadModel('Favorit');

		$favoriteCount = $this->Favorit->find('all',
			array(
				'fields ' => array('listing_id')
			)
		);

		if(!empty($favoriteCount))
		{
			foreach ($favoriteCount as $favoritNumber)
			{
				$number = count($favoritNumber['Favorit']['listing_id']);
			}

			$this->set(compact('number'));
		}
		else
		{
			$number = 0;
			$this->set(compact('number'));
		}
		/**
		*Inactive listing number.
		*/
		$this->set('userInactivListingCount', $userInactivListingCount);

		/**
		*Activ listing number.
		*/
		$this->set('userActivListingCount', $userActivListingCount);

		/**
		*Current user information
		*/
		$this->set( 'currentUser', $userInfo );
	}

	/**
	*After login,user profile edit.
	*/
	public function profile_edit()
	{
		$this->layout = 'after_login';
		$this->set( 'title_for_layout', __( 'Saját profilom modositása' ) );

		if( $this->request->is( 'put' ) )
		{
			$this->User->id = $this->Auth->user( 'id' );

			if( !empty( $this->request->data['User']['user_photo']['name'] ) )
			{
				$imageName = strtolower( $this->request->data['User']['user_photo']['name'] );
				$imageExtension = pathinfo( $imageName, PATHINFO_EXTENSION );
				$allowedExtension = strtolower( $imageExtension );
				$imageTmp = $this->request->data['User']['user_photo']['tmp_name'];
				$imageSize = $this->request->data['User']['user_photo']['size'];

				if( $imageSize >= 2049449 ) // 2MB
				{
						return $this->Session->setFlash(__( 'Két megabájtnál nem lehet nagyobb a kép!' ) );
				}

				if( $allowedExtension != 'jpeg' && $allowedExtension != 'png' && $allowedExtension != 'jpg' && $allowedExtension != 'gif' )
				{
					return $this->Session->setFlash(__( 'Csak (jpeg,jpg,png,gif) kiterjesztésü képeket szabad feltölteni!' ) );
				}

				$imagePlace = WWW_ROOT . 'img/users_photos/' . $imageName;
				$fileInfo = pathinfo( $imagePlace );
				$resizeImageDirectory = WWW_ROOT . 'img/users_photos/' . 'thumb_' . $fileInfo['basename'];

				if( move_uploaded_file( $imageTmp, $imagePlace ) );
				{
					$resizePhoto = $this->resizeImage( $imagePlace, 100, 100, $resizeImageDirectory ); // $filename, $max_width, $max_height
				}
			}

			$this->request->data['User']['user_photo'] = $imageName;

			/**
			*Save update profile data!
			*/
			if( $this->User->save( $this->request->data ) )
			{
				$this->Session->setFlash(__( 'Sikeres profil modositás! Adatok modosulni fognak ha újra bejelentkezel!!' ) );

				return $this->redirect(
					array(
						'controller' => 'users',
						'action' => 'userProfile'
					)
				);
			}
		}

		/**
		*Read edit form form original data.
		*/
		$this->request->data = $this->User->read( null, $this->Auth->user( 'id' ) );
	}

	/**
	*Logout the user,delete user our session.
	*/
	public function logout()
	{
		$this->redirect( $this->Auth->logout() );
	}

	/**
	*After user-registration, user get activation e-mail
	*/
	public function sendActivationEmail( $user_id )
	{
		$user = $this->User->find( 'first', array(
			'fields' => array( 
				'User.email_token',
				'User.username',
				'User.email',
				'User.id' 
			),
			'conditions' => array(
				'User.id' => $user_id 
			)
		) );

		$activate_url = 'http://' . env( 'SERVER_NAME' ) . '/diploma/' . '/users/activate/' . $user['User']['id'] . '/' . $user['User']['email_token'];

		$name = $user['User']['username'];

		$Email = new CakeEmail( 'gmail' );
		$Email->from( Configure::read( 'App.defaultEmail' ) );
		$Email->to( $user['User']['email'] );
		$Email->subject( env( 'SERVER_NAME' ) . ' ' . __( 'Igazold vissza a megerösitő e-mailt!' ) );
		$Email->template( 'registration' );
		$Email->emailFormat( 'html' );
		$Email->viewVars( array( 'activate_url' => $activate_url, 'name' => $name ) );

		return $Email->send();
	}

	/**
	*Activate user,database flag change 0 to 1!
	*/
	public function activate( $user_id = null, $activationHash = null ) 
	{
		$this->User->id = $user_id;

		if ( $this->User->exists() && $activationHash == $this->User->getActivationHash() )
		{
			/**
			*Update user_email_verified_status 0 to 1
			*/
			$this->User->saveField( 'user_email_verified_status', 1 );

			$this->Session->setFlash(__( 'Sikeresen aktiváltad fiókodat, kérlek jelentkezz be!' ) );

			$this->redirect(
				array(
					'controller' => 'users',
					'action' => 'login'
				)
			);
		}
	}

	/**
	*Forgott pasword logic-proces.
	*/
	public function forgot_password()
	{
		$this->set( 'title_for_layout', __( 'Elfelejtett jelszó' ) );

		if( !empty( $this->request->data ) && $this->request->is( 'post' ) )
		{
			if( $this->Recaptcha->verify() )
			{
				$user = $this->User->findByEmail( $this->request->data['User']['email'] );
				
				if( $user )
				{
					$userName = $user['User']['username']; //Get username,use forgot email template
					$user['User']['tmp_password'] = $this->User->createTempPassword( 7 );
					$user['User']['password'] = $user['User']['tmp_password'];
				
					if( $this->User->save( $user, false ) )
					{
						$this->sendPasswordEmail( $user, $user['User']['tmp_password'], $userName );

						$this->Session->setFlash(__( 'Az új jelszót elküldtük a megadott e-mail címre!' ) );
						$this->redirect( 'login' );
					}
				}
				else
				{
					$this->Session->setFlash(__( 'Ilyen e-mail cím nem létezik az adazbázisunkban!' ) );
				}
			}
			else
			{
				/**
				*Default recaptcha error.
				*/
				$this->Session->setFlash( $this->Recaptcha->error );
			}
		}
	}

	/**
	*Information about listing!
	*/
	public function listings_proces( $id ) 
	{
		$this->set( 'title_for_layout', __( 'Hirdetés megtekintése' ) );

		/**
		*This layout, use the action!
		*/
		if( $this->Session->read( 'Auth.User' ) )
		{
			$this->layout = 'after_login'; 
		}
		else
		{
			$this->layout = 'listing_details'; 
		}

		/**
		*Get information about specific listing!
		*/
		$getListingInfo = $this->User->Listing->find( 'all', array( 
			'conditions' => array(
				'Listing.id' => $id
		) ) );

		$this->set( 'getListingInfos', $getListingInfo  );

		if( !empty( $this->request->data ) )
		{
			$from = $this->request->data['User']['email']; //Kitől kapja az e-mailt(érdeklödőtöl!)
		
			$to = $this->User->find( 'first', array( //Hirdetés tulajdonosának e-mailt küldeni(tulajdonosnak küldi)
				'fields' => 'email',
				'conditions' => array( 'Listing.user_id' ) //Hirdetés tulajdonsának az e-mail cimet kell kiszedni.
			));

			$emailTo = current( $to );
			$listingUrl = $_SERVER['SERVER_NAME'] . $this->request->here;
			
			$message = array();
			$message['fullname'] = $this->request->data['User']['fullname'];
			$message['description_hu'] = $this->request->data['User']['description_hu'];
			$message['phone'] = intval($this->request->data['User']['phone']); //Convert to integer

			/**
			*E-mail küldése a hirdetés tulajdonosának.
			*/
			$this->sendContactListingOvnerMail( $from, $emailTo, $message, $listingUrl );
		}
	}
}

?>
