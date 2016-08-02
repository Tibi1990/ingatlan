<div class="listingown">
	<div class="listingown-inner">
		<table>
			<tr>
				<th>
					<?php
						echo __( 'INGATLNARÓL KÉPEK' );
					?>
				</th>

				<th>
					<?php
						echo $this->Paginator->sort( 'rent_price', __( 'ÁR ' ),
							array(
								'title' => __( 'Rendeze az árat növekvő / csökenő sorrendben! ' )
							)
						);

						echo $this->Html->image( 'down-arrow.png',
						array(
							'width' => 16,
							'height' => 17,
						));
					?>
				</th>

				<th>
					<?php
						echo $this->Paginator->sort( 'size ', __( 'TERÜLET ' ),
							array(
								'title' => __( 'Rendeze a területet növekvő / csökenő sorrendben! ' )
							)
						);
					
						echo $this->Html->image( 'down-arrow.png',
						array(
							'width' => 16,
							'height' => 17,
							
						));
					?>
				</th>

				<th>
					<?php
						echo $this->Paginator->sort( 'city', __( 'ELHELYEZKEDÉS ' ),
							array(
								'title' => __( 'Rendeze az elhelyezkedést abc sorrendben! ' )
							)
						);
						
						echo $this->Html->image( 'down-arrow.png',
						array(
							'width' => 16,
							'height' => 17,
						));
					?>
				</th>
			</tr>

			<?php
				foreach( $inactivListings as $listings ):
			?>
			<tr>
				<td> 
					<?php
						foreach ($listings['ListingImage'] as $key => $value): 
					
							echo $this->Html->image( "listing_uploads/" . "thumb_" .
								$listings['ListingImage'][$key]['name'],
							array(
								'alt' => __('Kép'),
								'class' => 'searchimageformat',
								'url' => array(
									'controller' => 'users',
									'action' => 'listings_proces',
									$listings['Listing']['id']
								)
							));	
						endforeach;
					?>
				</td>
				
				<td>
					<?php echo $listings['Listing']['rent_price'] . " euró"; ?>
				</td>

				<td>
					<?php echo $listings['Listing']['size'] . " m<sup>2</sup>"; ?>
				</td>

				<td>
					<?php echo $listings['Listing']['city']; ?>
				</td>

				<td class="after-indev-button"> <!--View button -->
					<?php
						echo $this->Html->link(__( 'Megtekintés' ),
							array(
								'controller' => 'users',
								'action' => 'listings_proces',
								$listings['Listing']['id']
						),
						array(
								'class' => 'btn btn-info'
						)
					);
					?>		
				</td>
			</tr>

			<?php endforeach; ?>

			<?php unset( $listings ); ?>
		</table>
	</div>

	<div class="paging">
		<?php

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
		?>
	</div>
</div>
