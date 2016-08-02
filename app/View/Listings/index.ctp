<!-- After login main page-->
<div id="mainsearch" style="display:none;">
	<?php
		echo $this->element('search/mainsearch');
	?>
</div>

<!-- HIRDETÉSKEZELÉS -->
<div class="listingown">
	<div class="listingown-inner">

		<?php
			/**
			*Check the user has listing,
			*SHOW,HIDDEN
			*/
			if( !empty($data) ):
		?>
	
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
				foreach( $data as $listings ):
			?>
			<tr>
				<td> 
					<?php
						foreach ($listings['ListingImage'] as $key => $value): 
					
						if( $value['admin_deleted'] != 0 ): //Csak enabled images show

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
						endif;

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

				<td> <!--Edit button -->
					<?php
						echo $this->Html->link(__( 'Szerkesztés' ),
							array(
							'controller' => 'listings',
							'action' => 'editListing',
							$listings['Listing']['id']
						),
						array(
							'class' => 'btn btn-warning'
						)
					);
					?>		
				</td>

				<td> <!--Delete button -->
					<?php
						echo $this->Html->link(__( 'Törlés' ),
							array(
								'controller' => 'listings',
								'action' => 'deleteListing',
								$listings['Listing']['id']
						),
						array(
								'class' => 'btn btn-danger',
								'confirm' => __('Biztos hogy törölni szeretnéd a hirdetésed?')
						)
					);
					?>		
				</td>

				<td> <!--Highlight button -->
					<?php
						/**
						*Highlight button disable
						*If the listing is highlight in the main page
						*/
						if(!empty($highlightListing))
						{
							//TODO Ezt szebben megoldani.
							if( $listings['Listing']['id'] !== $highlightListing[0]['Highlight']['listing_id'] )
							{
								//Highlight button
								echo $this->Html->link(__( 'Kiemelés' ),
									array(
										'controller' => 'highlights',
										'action' => 'index',
										$listings['Listing']['id']
								),
								array(
										'class' => 'btn btn-success',
										'confirm' => __( 'Biztos hogy ki akkarod emeleni ezt a hirdetést?' )
								));
							}
						}
						else{
								//Ha üres a highlight
								echo $this->Html->link(__( 'Kiemelés' ),
									array(
										'controller' => 'highlights',
										'action' => 'index',
										$listings['Listing']['id']
								),
								array(
										'class' => 'btn btn-success',
										'confirm' => __( 'Biztos hogy ki akkarod emeleni ezt a hirdetést?' )
								));
						}
					?>		
				</td>

				<td>
					<?php
						echo $this->Html->link(
							$this->Html->image('heart.png',
							array(
									'alt' => 'Heart,Favorite,Kedvencek',
									'class' => 'heart-favorite pulse',
									'title' => 'Kedvencnek jelölöm'
								)
							),
							array(
								'controller' => 'favorites',
								'action' => 'favorite',
								$listings['Listing']['id']
							),
							array(
								'id' => 'favorite',
								'escapeTitle' => false,
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

	<?php endif; ?>
</div>

<?php
	/**
	*Gyakran ismetelt kerdesek,
	*Adatvedelmi szabalyzat
	*/
	echo $this->element('info/websiteinfo');
?>
