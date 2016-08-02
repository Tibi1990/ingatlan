<?php
	class ConnectionsController extends AppController
	{	
		public function admin_page_error()
		{
			$this->layout = 'admin'; //This function use this layout
			$this->set( 'title_for_layout', __( 'Admin,oldalal kapcsolatos hibák' ) );

			/*
			*Database read only not fixed errors.
			*/
			$data = $this->Paginator->paginate(
				'Connection',
				array(
					'Connection.fixed <>' => 1
				)
			);

			$this->set( 'errors', $data );
		}

		/*
		*Database update 0-1
		*/
		public function admin_fixed_error($id)
		{
			$this->layout = 'admin';
			$this->set( 'title_for_layout', __( 'Admin' ) );

			if ( !$this->Connection->exists( $id ) ) 
			{
				throw new NotFoundException(__( 'Nincs ilyen hiba!' ) );
			}

			$this->Connection->id = $id;

			if( $this->Connection->saveField('fixed', 1) )
			{
				$this->Session->setFlash(__( 'Sikeres hiba javitás!' ) );

				/**
				*Redirect the same page.
				*/
				$this->redirect($this->referer());
			}

		}

		/**
		*User send review the site
		*/
		public function index()
		{
			$this->layout = 'default';
			$this->set( 'title_for_layout', 'Kapcsolat' );
			
			if( !empty( $this->request->data ) && $this->request->is('post') )
			{
				if( $this->Recaptcha->verify() )
				{
					if( $this->Connection->save( $this->request->data ) )
					{
						$this->Session->setFlash(__( 'Sikeres üzenet küldés,köszönyük a segitségét!' ) );
					}
				}
				else
				{
					$this->Session->setFlash( $this->Recaptcha->error );
				}
			}
		}
	}


?>