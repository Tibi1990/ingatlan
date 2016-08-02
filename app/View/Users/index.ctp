<!-- FÖOLDALI KERESÉS-->
<div class="wrapper">
	<div class="index-info">
		<h1>
			<?php echo  __( 'Legtöbb ingatlan egy helyen' ); ?>
		</h1>

		<p> 
			<?php
			 	echo __( 'Több mint 650 000 érdeklődő havonta, 494 487 ingatlanhirdetés,<br />
				1592 ingatlaniroda és több tízezer magánszemély kínálata.' );
			?>
		</p>
	</div>
	
	<?php 
		echo $this->element('search/mainsearch');
	 ?>
		
	<div class="listing-box">
		<?php echo $this->element( 'search/searchbox' ); ?>
	</div>
</div>