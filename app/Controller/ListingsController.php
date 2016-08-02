<?php

class ListingsController extends AppController
{
	/**
	*This function is executed before every action in the controller.
	*/
	public function beforeFilter( $options = array() )
	{
		/**
		*Call AppController,
		*beforeFilter() function!
		*/
		parent::beforeFilter();

		/**
		*Non logged users, acces this function!
		*/
		$this->Auth->allow(
			'listingAdd',
			'searchFilter',
			'editListing',
			'deleteListing',
			'activ_listing',
			'inactiv_listing'
		);

		/**
		*Read the user session.
		*/
		$user = $this->Auth->user();
	}

	/**
	*ADMIN Listings main page,
	*Show the all listtins in the admin.
	*/
	public function admin_index()
	{
		$this->layout = 'admin'; //This function use this layout
		$this->set( 'title_for_layout', __( 'Admin' ) );

		$this->Listing->recursive = 0;
		$this->set( 'listings', $this->Paginator->paginate('Listing') );
	}

	/**
	*ADMIN Information about listing.
	*/
	public function admin_view( $id = null ) 
	{
		$this->layout = 'admin';
		$this->set( 'title_for_layout', __('Admin') );

		if ( !$this->Listing->exists( $id ) ) 
		{
			throw new NotFoundException(__( 'Hirdetés nem létezik!' ) );
		}

		$options = array(
			'conditions' => array(
				$this->Listing->primaryKey => $id
			),
			'contain' => 'ListingImage'
		);

		$this->set( 'listing', $this->Listing->find( 'first', $options ) );
	}

	/**
	*ADMIN Edit listing.
	*/
	public function admin_edit( $id = null ) 
	{
		$this->layout = 'admin';
		$this->set( 'title_for_layout', __( 'Admin' ) );

		if ( !$this->Listing->exists( $id ) ) 
		{
			throw new NotFoundException(__( 'Nincs ilyen hirdetés!' ) );
		}

		if ( $this->request->is( array( 'post', 'put' ) ) ) 
		{
			if ( $this->Listing->save( $this->request->data ) ) 
			{
				$this->Session->setFlash(__( 'Hirdetés sikeresen lett módosítva!' ) );

				return $this->redirect( array( 
					'controller' => 'listings',
					'action' => 'admin_index' 
				) );
			}
		} 
		else 
		{
			$options = array( 'conditions' => array( 'Listing.' . $this->Listing->primaryKey => $id ) );
			$this->request->data = $this->Listing->find( 'first', $options );
		}
	}

	/**
	*ADMIN Delete specific listing.
	*/
	public function admin_delete( $id = null ) 
	{
		$this->layout = 'admin';
		$this->set( 'title_for_layout', __( 'Admin' ) );

		$this->Listing->id = $id;

		if ( !$this->Listing->exists() ) 
		{
			throw new NotFoundException(__( 'Ilyen hirdetés nem létezik!' ) );
		}

		$this->request->onlyAllow( 'post', 'delete' );

		if ( $this->Listing->delete( $id ) ) 
		{
			$this->Session->setFlash(__( 'A hirdetés sikeresen törölve lett!' ) );

			return $this->redirect( array( 
				'controller' => 'listings',
				'action' => 'admin_index' 
			) );
		}
		else 
		{
			return $this->Session->setFlash(__( 'A hirdetést nem sikerült törölni!' ) );
		}
	}

	/**
	*Admin aktivate the specific listing
	*Database 0-1
	*At kell billentenem az adatbazisba a mezot 0 rol egyesre.
	*/
	public function admin_aktiv($id = null)
	{
		$this->layout = 'admin';
		$this->set( 'title_for_layout', __( 'Admin' ) );

		$this->Listing->id = $id;

		if ( !$this->Listing->exists() ) 
		{
			throw new NotFoundException(__( 'Ilyen hirdetés nem létezik!' ) );
		}

		if( $this->Listing->saveField( 'admin_aktiv', 1 ) )
		{
			$this->Session->setFlash('Sikeres aktiválás');

			return $this->redirect( array( 
				'controller' => 'listings',
				'action' => 'admin_index' 
			) );
		}
	}

	/**
	*Admin aktivate the specific listing
	*Database 1-0
	*At kell billentenem az adatbazisba a mezot 0 rol egyesre.
	*/
	public function admin_inaktiv($id = null)
	{
		$this->layout = 'admin';
		$this->set( 'title_for_layout', __( 'Admin' ) );

		$this->Listing->id = $id;

		if ( !$this->Listing->exists() ) 
		{
			throw new NotFoundException(__( 'Ilyen hirdetés nem létezik!' ) );
		}

		if( $this->Listing->saveField( 'admin_aktiv', 0 ) )
		{
			$this->Session->setFlash('Sikeres inaktiválás');

			return $this->redirect( array( 
				'controller' => 'listings',
				'action' => 'admin_index' 
			) );
		}
	}

	/**
	*ADMIN Only activ listings show the admin.
	*/
	public function admin_activ_listings()
	{
		$this->layout = 'admin';
		$this->set( 'title_for_layout', __( 'Admin' ) );

		$this->Paginator->settings = array(
			'conditions' => array(
				'Listing.admin_aktiv' => 1
			)
		);

		$activListings = $this->Paginator->paginate('Listing');
			
		$this->set('activListings', $activListings);
	}

	/**
	* ADMIN only inactiv listings show the admin.
	*/
	public function admin_inaktiv_listings()
	{
		$this->layout = 'admin';
		$this->set( 'title_for_layout', __( 'Admin' ) );

		$this->Paginator->settings = array(
			'conditions' => array(
				'Listing.admin_aktiv' => 0
			)
		);

		/**
		*Show inactiv listings(read the database inactiv listings)
		*/
		$inactivListings = $this->Paginator->paginate('Listing');
			
		$this->set('inactivListings', $inactivListings);
	}

	/**
	*Admin enabled images.
	*FLAG DATABASE admin_deleted 0-1
	*/
	public function admin_enabled_image($id = null)
	{
		$this->loadModel('ListingImage');

		$this->ListingImage->id = $id;
		$this->ListingImage->saveField('admin_deleted', '1');

		$this->redirect($this->referer());
	}

	/**
	*Admin disabled images
	*FLAG DATABASE admin_deleted 0-1
	*/
	public function admin_disabled_image($id = null)
	{
		$this->loadModel('ListingImage');

		$this->ListingImage->id = $id;
		$this->ListingImage->saveField('admin_deleted', '0');

		$this->redirect($this->referer());
	}
	
/***********************************************************
*ADMIN FUNCTIONS END
************************************************************
************************************************************/

	/**
	*Default pagination settings!!
	*/
	public $paginate = array(
		'Listing' => array(
			'limit' => 8,
			'order' => array(
				'listing.created' => 'asc'
			)
		)
	);

	/**
	*After login index page!!
	*/
	public function index()
	{
		/**
		*Load highlight model in listing controller.
		*/
		$this->loadModel('Highlight');

		/**
		*This layout use function.
		*/
		$this->layout = 'after_login';
		$this->set( 'title_for_layout', __( 'Hirdetések kezelése' ) );

		//Read the session
		$userInfo = $this->Auth->user();

		/**
		*If the user has not logged then redirect
		*/
		if( empty( $userInfo ) )
		{
			return $this->redirect(
				array(
					'controller' => 'users',
					'action' => 'login'
				)
			);
		}

		/**
		*After login,users private listings
		*/
		$this->Paginator->settings = array(
			'Listing' => array(
				'conditions' => array(
					'User.username' => $this->Session->read( 'Auth.User.username' ),
					'Listing.deleted !=' => 1, //Deleted lisings not show the user private listings.
					'Listing.admin_aktiv !=' => 0, //Only activ listings show the user.
				),
				'order' => array(
					'Listing.created' => 'asc' //Order by listings created.
				),
				'limit' => 8 //Max listings limit.
			)
		);

		$data = $this->Paginator->paginate( 'Listing' );
		$this->set( compact( 'data' ) );

		/**
		*User highlight listings find the database
		*/
		$highlightListing = $this->Highlight->find('all',array(
			'conditions' => array(
				'Highlight.user_id' => $this->Session->read('Auth.User.id')
			),
			'contain' => false
		));

		$this->set( 'highlightListing', $highlightListing );

		/**
		*Load favorite model
		*/
		$this->loadModel('Favorit');

		$favoritListings = $this->Favorit->find('all',
			array(
				'conditions' => array(
					'user_id' => $this->Session->read('Auth.User.id') 
				)
			)
		);

		$this->set( compact('favoritListings') );
	}

	/**
	*After login!!
	*Add listing(Hirdetésfeladás)!!
	*/
	public function listingAdd()
	{
		//Which layout use in action
		$this->layout = 'after_login';
		$this->set( 'title_for_layout', __( 'Hirdetés feladása' ) );

		//Load listingimage model!
		$this->loadModel( 'ListingImage' ); 

		if( !empty( $this->request->data ) && $this->request->is( 'post' ) )
		{
			/***
			*Max allowed upload image-check.
			*Max allowed image upload-3.
			*/
			if( count($this->request->data['ListingImage']['name'] ) > 3  )
			{
				return $this->Session->setFlash(__( 'Maximum három fényképet lehet feltölteni!' ) );
			}
			/**
			*Save data in the listing table
			*/
			if($this->Listing->save($this->request->data))
			{
				$this->Session->setFlash(__('Sikeres hirdetésfeladás!! Adminak aktiválni kell ahhoz hogy megjelnjen az aktiv ingatlanok között!!'));
			}
			
			foreach( $this->request->data['ListingImage']['name'] as $imagesInfo )
			{
				$this->ListingImage->create();

				$imageName = strtolower( $imagesInfo['name'] ); //IMAGE NAME LOWERCASE
				$imageExtension = pathinfo( $imageName, PATHINFO_EXTENSION ); //GET IMAGE EXTENSION.
				$imageTmp = $imagesInfo['tmp_name']; //GET IMAGE TMP LOCATION.
				$imageSize = $imagesInfo['size']; //GET IMAGE SIZE

				$allowedExtension = strtolower( $imageExtension ); //SECURITY CONVERT EXTENSION INTO LOWERCASE.

				/**
				*Check allowed image extension!
				*/
				if( 
					$allowedExtension != 'jpeg'
					&& $allowedExtension != 'png' 
					&& $allowedExtension != 'jpg' 
					&& $allowedExtension != 'gif' 
				)
				{
					//HA NEM EGYENLŐ A FELSOROLT ÉRTÉKEKKEL AKKOR MEGJELENIK A HIBAÜZENET.
					$this->Session->setFlash(__( 'Csak (jpeg, jpg, png, gif) kiterjesztésü képeket szabad feltölteni!' ) );
				}
				
				if( $imageSize > 2049449 ) // MAX-2MB IMAGE ALLOW UPLOAD
				{
					return $this->Session->setFlash(__( 'Két megabájtnál nem lehet nagyobb a kép!!' ) );
				}

				$imagePlace = WWW_ROOT . 'img/listing_uploads/' . $imageName; //IMAGE UPLOAD FOLDER.
				$fileInfo = pathinfo( $imagePlace ); //RETURNS INFORMATION ABOUT PATH.
				$resizeImageDirectory = WWW_ROOT . 'img/listing_uploads/' . 'thumb_' . $fileInfo['basename']; //RESIZE IMAGE UPLOAD FOLDER.


				$this->request->data['ListingImage']['name'] = $imageName; //??

				if( move_uploaded_file( $imageTmp, $imagePlace ) );
				{
					/***
					*RESIZEIMAGE MEGHIVÁSA APPCONTROLLER-BŐL TÖRTÉNIK!!!
					*/
					$resizePhoto = $this->resizeImage( $imagePlace, 187, 177, $resizeImageDirectory );

					/***
					*ORIGINAL IMAGE ADD TO WATERMARK!
					*/
					$this->addWatermarkToImage( $imagePlace );
				}

				/**
				*SAVE DATA THE LISTING_IMAGES TABLE.
				*/
				$data = array(
					'user_id' => $this->Session->read( 'Auth.User.id' ),
					'listing_id' => $this->Listing->id,
					'name' => $imageName,
					'size' => $imageSize,
					'mime' => $imageExtension
				);

				/**
				*Save ListingImage table.
				*Multiple image upload
				*/
				$this->ListingImage->save( $data );

			} //END THE FOREACH!!
			
			return $this->redirect(
				array(
					'controller' => 'listings',
					'action' => 'index'
				)
			); 
		}
	}

	/**
	*Sort-search function with pagination.
	*I use main page and after login
	*/
	public function search_index()
	{
		/*
		*Page title
		*/
		$this->set( 'title_for_layout', __( 'Hirdetés keresése' ) );

		/**
		*If the search is after login,
		*then use the after_login layout.
		*Ha a felhasznalo be van jelentkezve akkor after_login layoutot hassznalya.
		*/
		if( $this->Session->read('Auth.User') )
		{
			$this->layout = 'after_login';
		}
		else
		{
			//Non logged user,render default layout
			$this->layout = 'default';
		}
		
		if( !empty( $this->request->data ) )
		{
			$statusRent = $this->request->data['Listing']['status_rent']; //Eladó,Kiadó
			$status = $this->request->data['Listing']['status']; //Lakás,Ház
			$city = $this->request->data['Listing']['city']; //Szabadka
			$rentPrice = $this->request->data['Listing']['rent_price']; //Ar
			$listingSize = $this->request->data['Listing']['size']; //Alapterulet
			
		//	debug($this->request->data);exit();

			/**
			*What data paginator settings use.
			*/
			$this->Paginator->settings =  array(
				'Listing' => array(
					'fields' => array(
						'id',
						'status_rent',
						'status',
						'city',
						'rent_price',
						'size',
						'description_hu',
						'deleted',
						'admin_aktiv'
					),
					'conditions' => array(
						'Listing.deleted <>' => 1, //Törölt hirdetéseket ne keressen.
						'Listing.admin_aktiv <>' => 0, //1-AKTIV,0-INAKTIV
						'Listing.status_rent' => $statusRent, //Eladó,Kiadó
						'Listing.status' => $status, //Lakás,Ház	
							'OR' => array(
								'Listing.city LIKE' => "%$city%",
								'Listing.rent_price LIKE' => $rentPrice, //Ingatlan ára
								'Listing.size LIKE' => $listingSize //Alapterület
							)
						),
					'contain' => 'ListingImage',
					'limit' => 8,
					'recursive' => -1,
					'order' => array(
						'Listing.created' => 'asc'
					)
				)
			);
			/*
			*Pagination process.
			*/
			$data = $this->Paginator->paginate( 'Listing' );

			$this->set( 'searchIndex', $data );
			$this->Session->write( 'data', $this->request->data );
			
		}
		else
		{
			$city = $this->Session->read('data.Listing.city');
		
			$this->Paginator->settings =  array(
				'Listing' => array(
					'fields' => array(
						'id',
						'status_rent',
						'status',
						'city',
						'rent_price',
						'size',
						'description_hu',
						'deleted',
						'admin_aktiv'
					),
					'conditions' => array(
						'Listing.deleted <>' => 1, //Deleted listings not show.,
						'Listing.admin_aktiv <>' => 0, //1-AKTIV,0-INAKTIV
						'Listing.status_rent' => $this->Session->read('data.Listing.status_rent'), //Eladó,Kiadó
						'Listing.status' => $this->Session->read('data.Listing.status'), //Lakás,Ház	
							'OR' => array(
								'Listing.city LIKE' => "%$city%",
								'Listing.rent_price LIKE' => $this->Session->read('data.Listing.rent_price'), //Ingatlan ára
								'Listing.size LIKE' =>  $this->Session->read('data.Listing.size') //Alapterület
							)
						),
					'limit' => 8,
					'contain' => 'ListingImage',
					'recursive' => -1,
					'order' => array(
						'Listing.created' => 'asc'
					),
				)	
			);

			/**
			*Pagination process
			*/
			$data = $this->Paginator->paginate( 'Listing' );

			$this->set( 'searchIndex', $data );		
		}
	}

	/**
	*After login user
	*Edit user own listing!
	*/
	public function editListing( $id = null)
	{
		/**
		*Which cake layout use action.
		*/
		$this->layout = 'after_login';

		/**
		*Load ListingImage model the the current function.
		*/
		$this->loadModel('ListingImage');

		/**
		*Hirdertes szerkesztesnel azokat a hirdeteseket kihuzzni,
		*amitt a felhasznalo addott fel.Annal a hirdetesnel amiit szerkeszteni akkarunk.
		*/
		$listingImages = $this->ListingImage->find('all', array(
			'conditions' => array(
				'user_id' => $this->Session->read('Auth.User.id'),
				'listing_id' => $id
			)
		));

		/**
		*If the form has not submited,
		*Read the listing data back.
		*/
		if( empty($this->request->data) ){
			$this->request->data = $this->Listing->read( '', $id );

			$this->set( 'listingImages', $listingImages  );
			$this->set( 'data', $this->request->data  );
		}
		else
		{
			/**
			*The edit action is save
			*/
			$this->Listing->save( $this->request->data );
			{
				$this->Session->setFlash(__( 'A hirdetést sikeresen módosítottad!!' ) );

				$this->redirect(
					array(
						'controller' => 'listings',
						'action' => 'index'
					)
				);
			}	
		}
	}

	/**
	*Soft delete listing table,
	*update delete field 0 to 1
	*/
	public function deleteListing( $id = null )
	{
	 	$this->Listing->id = $id;

    	if ( !$this->Listing->exists() )
    	{
        	throw new NotFoundException(__('Ez a hirdetés nem létezik') );
    	}

    	if( $this->Listing->saveField( 'deleted', 1 ) )
    	{
    		$this->Session->setFlash(__( 'Sikeresen törölted a hirdetésed!!<br />
    			Hirdetésedet ha vissza szeretnéd állitani akkor ved fel velünk a kapcsolatot!' ) );

    		return $this->redirect(
				array(
					'controller' => 'listings',
					'action' => 'index'
				)
			);
    	}
	}

	/**
	*User activ listings in the profile menu.
	*/
	public function activ_listing()
	{
		$this->layout = 'after_login';
		$this->set( 'title_for_layout', __( 'Aktiv hirdetések!' ) );

		
		$activListings = $this->Paginator->paginate(
			'Listing',
			array(
				'Listing.admin_aktiv' => 1,
				'User.id' => $this->Auth->user( 'id' )
			)
		);
		
		if( empty($activListings) )
		{
			$this->Session->setFlash(__('Nincs aktiv hirdetésed!!'));
			$this->redirect($this->referer());
		}


		$this->set( 'activListings', $activListings );
	}

	/**
	*User inactiv listings.
	*/
	public function inactiv_listing()
	{
		$this->layout = 'after_login';
		$this->set( 'title_for_layout', __( 'Inaktiv hirdetések' ) );

		
		$inactivListings = $this->Paginator->paginate(
			'Listing',
			array(
				'Listing.admin_aktiv' => 0,
				'User.id' => $this->Auth->user( 'id' )
			)
		);
			
		if( empty($inactivListings) )
		{
			$this->Session->setFlash(__('Nincs inaktiv hirdetésed!!'));
			$this->redirect($this->referer());
		}

		$this->set( 'inactivListings', $inactivListings );
	}
}

?>