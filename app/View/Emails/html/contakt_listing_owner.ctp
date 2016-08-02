<p>
	<?php
		echo __( "Kedves <b>hirdetőnk</b> 
			üzeneted érkezett a következő hirdetésedre:<a href=$url>Hirdetés</a>" ) . "<br />";
	?>	
</p>

<p>
	<b>Érdeklödő adatai:</b>
</p>

<?php
	echo __('<b>Név:</b> '. $message['fullname']) . "<br />";
	echo __('<b>Telefon:</b> '. $message['phone']) . "<br /><br />";
	echo __('<b>Üzenet:</b> '. $message['description_hu']);
?>
