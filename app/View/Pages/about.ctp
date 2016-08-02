<div id="pages-about">

	<div class="section">
		<?php echo $this->Html->image('info-about.png', array(
			'height' => '70px',
			'width' => '120px',
			'alt' => __( 'Info' ),
			'style' => 'display:block' 
			) ); 
		?>

		<br />

		<span class="page-about-header"> <?php echo __( 'Bemutatkozás' ); ?> </span>

		<p class="page-about-font">
			<?php
				echo __('Az <b>Alberlet</b> 2014. májusában indult ingatlanközvetítő portál, amely gyors ütemben a legnagyobbak közé küzdötte fel magát: a közel 200 ezres adatbázis és a több száz irodából és magánhirdetőből álló partnerhálózat garancia a sikerre. Országosan kínálunk eladó-kiadó lakásokat, családi házakat, irodákat, nyaralókat, ipari ingatlanokat, telkeket a legrészletesebb keresőrendszerünkben. A látogatók az ingatlankeresés mellett tájékozódhatnak az ingatlanpiac híreiről a naponta többször frissülő cikkekből. Látogatóink visszajelzései és a piac folyamatos vizsgálata alapján rendszerünket folyamatosan fejlesztjük, hogy megőrizzük az elmúlt években megszerzett előkelő piaci pozíciónkat.');
			?>
		</p>
	</div>
	
	<hr />

	<div class="section">

		<?php echo $this->Html->image('strengh-about.png', array(
			'height' => '70px',
			'width' => '120px',
			'alt' => __( 'Strengh' ),
			'style' => 'display:block' 
			) ); 
		?>

		<br />

		<span class="page-about-header"> <?php echo __( 'Erősségeink' ) ?> </span>

		<ul>
			<li><?php echo __( 'Ingyenes hirdetésfeladás' ); ?> </li>
			<li><?php echo __('Magyarország egyik leglátogatottabb ingatlan oldala'); ?> </li>
			<li><?php echo __('Közel 100 ezer ingatlant tartalmazó adatbázis'); ?> </li>
			<li><?php echo __('Karbantartott, folyamatosan aktualizált kínálat'); ?> </li>
			<li><?php echo __('Jól kiépített partnerhálózat: közel 900 ügynökségi kapcsolat'); ?> </li>
			<li><?php echo __('Legrészletesebb keresőrendszer'); ?> </li>
		</ul>

	 <?php

	 	echo __( 'Ha <b>regisztárlni</b> szeretnél itt megteheted: ' ) .
	 	$this->Html->link(__( 'Regisztráció' ), array( 'controller' => 'users', 'action' => 'registration' ),array( 'target' => '_blank' ) );
 	?>

	</div>

	<hr />

	<div class="section">

		<?php echo $this->Html->image('operator-about.png', array(
				'height' => '70px',
				'width' => '120px',
				'alt' => 'Operator',
				'style' => 'display:block' 
				) ); 
			?>

		<br />

		<span class="page-about-header"><?php echo __( 'Üzemeltető' ); ?> </span>

		<ul>
			<li> <?php echo __( 'Ingatlanok Magyarország Kft.' ); ?> </li>
			<li> <?php echo __( '6800 Hódmezővásárhely' ); ?> </li>
			<li> <?php echo __( 'Szántó Kovács János utca 122.' ); ?> </li> 
			<li> <?php echo __( 'cégjegyzékszám: 01-09-975194' ); ?> </li>
			<li> <?php echo __( 'adószám: 23720675-2-41' ); ?> </li>
		</ul>
	</div>

	<hr />

	<div class="section">
		<?php echo $this->Html->image('info-about.png', array(
				'height' => '70px',
				'width' => '120px',
				'alt' => 'Info',
				'style' => 'display:block' 
				) ); 
			?>

		<br />

		<span class="page-about-header"> <?php echo __( 'Információ' ); ?> </span>

		<p class="page-about-font">
			<?php
				echo __( 'Ha ingatlanirodaként szeretne bekerülni kínálatával az Ingatlanok.hu portálra, kérjük kattintson ide!
				Ha magánszemélyként szeretne hirdetést feladni, kérjük regisztráljon itt!
				Ha szeretne az ingatlanok.hu-n hirdetési felületet bérelni, kérjük írjon az alábbi címre : sales@epicenter.hu' );
			?>
		</p>
	</div>
	
	<hr />

	<div class="section">
	
		<?php echo $this->Html->image('phone-about.png', array(
			'height' => '70px',
			'width' => '120px',
			'alt' => __( 'Phone' ),
			'style' => 'display:block' 
			) ); 
		?>

		<br />

		<span class="page-about-header"> <?php echo __( 'Elérhetőség' ); ?> </span>

		<ul>
			<li><?php echo __( 'E-mail: info@ingatlanok.hu' ); ?> </li>
			<li><?php echo __( 'Fax: 1/999-1840' ); ?> </li> 
		</ul>
	</div>

	<hr />

	<div class="section">

		<?php echo $this->Html->image('map.png', array(
			'height' => '70px',
			'width' => '120px',
			'alt' => 'Map',
			'style' => 'display:block' 
		) ); 
		?>

		<br />

		<span class="page-about-header"> <?php echo __( 'Térképen' ); ?> </span>

		<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d696.4166829503685!2d19.664947915344776!3d45.717722281617114!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475b5338fc1c8283%3A0x143645a0946f4939!2zTGVoZWxvdmEsIE1hbGkgScSRb8WhLCBTemVyYmlh!5e0!3m2!1shu!2shu!4v1409551697651" width="1100" height="450" frameborder="0" style="border:0"></iframe>
	</div>

</div>