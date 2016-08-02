<?php echo __( 'Köszöntelek kedves ' ) ?> <b> <?php echo $name ."!"; ?> </b>

<?php
	echo __( '<p>Köszönöm hogy regisztráltál,kérlek kattints a megerösitő hivatkozásra hogy teljes értékü legyen a felhasználoi fiókod!</p>' )
?> 


<a href = <?php echo $activate_url ?> > <?php echo __( 'Megerösitő hivatkozás' ); ?> </a>