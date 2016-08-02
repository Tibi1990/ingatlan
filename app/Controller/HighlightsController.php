<?php 

class HighlightsController extends AppController{

	/**
	*Admin highlight listings
	*/
	public function admin_highlight()
	{
		$this->layout = 'admin'; //This function use this layout
		$this->set( 'title_for_layout', __( 'Admin' ) );

		//Read the database highlight with pagination
		$highlightListings = $this->Paginator->paginate('Highlight');
		$this->set( 'highlightListings',$highlightListings );
	}

	/**
	*Information about highlight Admin.
	*/
	public function admin_view( $id = null ) 
	{
		$this->layout = 'admin';
		$this->set( 'title_for_layout', __('Admin') );

		$highlightListing = $this->Highlight->Listing->find('first',
			array(
				'conditions' => array(
					'Listing.id' => $id
				),
			)
		);
	
		$this->set( 'listing', $highlightListing );
	}

	/**
	*Highlight delete
	*/
	public function admin_delete( $id = null ) 
	{
		$this->layout = 'admin';
		$this->set( 'title_for_layout', __( 'Admin' ) );

		$this->Highlight->id = $id;

		if ( !$this->Highlight->exists() ) 
		{
			throw new NotFoundException(__( 'Nincs ilyen kiemelt hirdetés!' ) );
		}

	//	$this->request->onlyAllow( 'post', 'delete' );

		if ( $this->Highlight->delete( $id ) ) 
		{
			$this->Session->setFlash(__( 'A kiemelés sikeresen törölve lett!' ) );

			return $this->redirect( $this->referer() );
		}
		else 
		{
			return $this->Session->setFlash(__( 'A kiemelést nem sikerült törölni!' ) );
		}
	}

/***********************************************************************
*ADMIN FUNCTIONS END
************************************************************************
*************************************************************************/

	/**
	*When the user buy highlight pack.
	*And save the highlight table
	*/
	public function index()
	{
		if($this->request->is('post'))
		{
			if(!empty($this->request->data))
			{
				$highlightsRequestData = $this->request->data;
		
				if( $this->Highlight->save($highlightsRequestData) )
				{
					$this->Highlight->Listing->id = $highlightsRequestData['Highlight']['listing_id'];
					$this->Highlight->Listing->saveField('highlight', 1); //Update listing highlight 0-1

					/**
					*Write highlight information.
					*/
					$this->Session->write('Highlight.information', $highlightsRequestData);

					$this->redirect(
						array(
							'controller' => 'listings',
							'action' => 'index'
						)
					);
				}
			}
		}
	}
}


 ?>