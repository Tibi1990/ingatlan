<?php 

class FavoritesController extends AppController
{
	/**
	*Mus be present,if missing the save has not work
	*/
	public $uses = 'Favorit';

	public function beforeFilter( $options = array() )
	{
		/**
		*Call AppController,
		*beforeFilter() function!
		*/
		parent::beforeFilter();

		/**
		*Non logged users acces this function!
		*/
		$this->Auth->allow(
			'favorite',
			'show_favorite',
			'delete_favorite'
		);
	}

	/**
	*Save the database
	*/
	public function favorite($id = null)
	{
		//The user has logged in!!
		if( $this->Session->read('Auth.User') )
		{	
			$data = array(
					'listing_id' => $id,
					'user_id' => $this->Session->read( 'Auth.User.id' )
				);

			//Sava favorites table
			if( $this->Favorit->save( $data ) )
			{
				$this->Session->setFlash(__('Sikeres kedvencnek jelölés! Profilodba megtalálod a kedvencnek jelölt hirdetéseidet'));

				$this->redirect(
					array(
						'controller' => 'listings',
						'action' => 'index'
					)
				);
			}
		}
		else
		{
			$this->Session->setFlash(__('Be kell jelentkezned hogy kedvencnek tud jelölni a hirdetéseket!'));

			/**
			*If the user has not logged,
			*then redirect the login page.
			*/
			$this->redirect(
				array(
					'controller' => 'users',
					'action' => 'login'
				)
			);
		}
	}

	/**
	*Show favorite listings when click the,
	*user profile FAVORITE button.
	*User saját kedvenc hirdetéseit listázá ki
	*/
	public function show_favorite()
	{
		$this->loadModel('Listing');

		$this->layout = 'after_login';
		$this->set( 'title_for_layout', __( 'Kedvenc hirdetések' ) );

		$favorites = $this->Favorit->find('all',array(
			'fields' => array('Favorit.listing_id','Favorit.user_id'),
			'conditions' => array(
				'Favorit.user_id' => $this->Session->read('Auth.User.id'),
			)
		));
		
		/**
		*Nincs a felhaználonak KEDVENC hirdetése.
		*/
		if ( empty($favorites) )
		{
			$this->Session->setFlash(__('Nincs kedvenc hirdetésed!!'));
			$this->redirect( $this->referer() );
		}

		foreach ($favorites as $listing )
		{
			$favoriteListings = $this->Paginator->paginate(
				'Listing',
				array(
					'Listing.id' => $listing['Favorit']['listing_id']	
				)
			);
		}
		
		$this->set( compact( 'favoriteListings' ) );
	}

	/*
	*User delete own(saját) favorite(kedvenc) listing(hirdetéseit).
	*Saját kedvenc hirdetést törölni.
	*/
	public function delete_favorite($id = null)
	{
		$findFavorit = $this->Favorit->find('first',array(
			'conditions' => array(
				'Favorit.listing_id' => $id
			)
		));

		$deleteFavoritListingId = $findFavorit['Favorit']['id']; 

		if( $this->Favorit->delete($deleteFavoritListingId) )
		{
			$this->Session->setFlash(__('Sikeresen törölted a kedvencet!'));

			$this->redirect($this->referer());
		}
	}
}


?>