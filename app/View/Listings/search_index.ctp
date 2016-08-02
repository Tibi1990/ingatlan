<div class="search-result-show">
	<table>
		<tr>
			<th>
				<?php echo __( 'KÉP' ); ?>
			</th>

			<th>
				<?php
					echo $this->Paginator->sort( 'rent_price', __( 'ÁR ' ),
						array(
							'id' => 'rent_price-sort',
							'title' => __( 'Rendeze az árat növekvő / csökenő sorrendben! ' )
						)
				 	);

					echo $this->Html->image( 'down-arrow.png',
						array(
							'width' => 16,
							'height' => 17,
							'alt' => 'Sort',
							'class' => 'down-arrow-rent-price'
						)
					);
				?>
			</th>
			
			<th>
				<?php
					echo $this->Paginator->sort( 'size ', __( 'TERÜLET ' ),
						array(
							'id' => 'rent_price-size',
							'title' => __( 'Rendeze a területet növekvő / csökenő sorrendben! ' )
						)
				 	);

					echo $this->Html->image( 'down-arrow.png',
						array(
							'width' => 16,
							'height' => 17,
							'alt' => 'Sort',
							'id' => 'down-arrow-rent-size'
						) 	
					);
				?>
			</th>

			<th>
				<?php 
					echo $this->Paginator->sort( 'city', __( 'TELEPÜLÉS ' ),
						array(
							'id' => 'rent_price-city',
							'title' => __( 'Rendeze az elhelyezkedést abc sorrendben! ' )
						)
				 	);

					echo $this->Html->image( 'down-arrow.png',
						array(
							'width' => 16,
							'height' => 17,
							'alt' => 'Sort',
							'id' => 'down-arrow-rent-city'
						) 	
					);
				?>
			</th>

			<th>
				<?php echo __( 'INGATLAN LEÍRÁSA' ); ?>
			</th>

			<th>
				<?php echo __( 'INGATLAN MENTÉSE' ); ?>
			</th>
		</tr>

		<?php 
			foreach( $searchIndex as $searchResult ): 
		?>
				<tr>
					<td> 
						<?php
							/*
							*Itt mindig az elso kepet huza ki.
							*/
					 		echo $this->Html->image( "listing_uploads/" . "thumb_" .
								$searchResult['ListingImage'][0]['name'],
							array(
								'alt' => __( 'Hirdetés fényképe' ),
								'class' => 'searchimageformat',
								'url' => array(
									'controller' => 'users',
									'action' => 'listings_proces',
									$searchResult['Listing']['id']
								)
							));
						?>
					</td>
					
					<td>
						<?php echo $searchResult['Listing']['rent_price'] . " euró"; ?>
					</td>

					<td>
						<?php echo $searchResult['Listing']['size'] . " m<sup>2</sup>"; ?>
					</td>

					<td>
						<?php echo $searchResult['Listing']['city']; ?>
					</td>

					<td class="search-result-description">
						<?php
							if( !empty( $searchResult['Listing']['description_hu'] ) )
							{
								echo $searchResult['Listing']['description_hu'];
							}
						?>
					</td>
					
					<td>
						<?php
							/**
							*Heart favorite-image search result
							*/
							echo $this->Html->link(
    							$this->Html->image('heart.png',
								array(
										'alt' => 'Heart,Favorite,Kedvencek',
										'class' => 'heart-favorite pulse'
									)
								),
								array(
    								'controller' => 'favorites',
    								'action' => 'favorite',
    								 $searchResult['Listing']['id']
								),
    							array(
    								'escapeTitle' => false,
								)
							);
						?>
					</td>

				</tr>

		<?php endforeach; ?>

		<?php unset( $searchResult ); ?>
	</table>
	
	<!-- Search index,pagination -->
	<div class="paging">
		<?php

			echo $this->Paginator->first( __( '<< Első' ) );

			echo $this->Paginator->prev(
			  	' << ' . __( 'Elöző' ),
			  	array(),
			 	 null,
			  	array(
			  		'class' => 'prev disabled'
		  		)
			);

			echo $this->Paginator->numbers();

			echo $this->Paginator->next(
		  		 __( 'Következő' ) . ' >> ',
		  		array(),
		 	 	null,
		  		array(
		  			'class' => 'next disabled'
	  			)
			);

			echo $this->Paginator->last( __( 'Utolsó >>' ) );
		?>
	</div>
</div>

