<p> 
	<?php
		echo __('Új jelszavad a következő:');
	?>

	<b> <?php echo $password . "<br />"; ?> </b>
	<?php echo __("Felhasználonév: ") . "<b>" . $userName . "</b>"; ?>
</p>

<?php
	echo $this->Html->link(
	__('Bejelentkezés'),
	array(
		'controller' => 'users',
		'action' => 'login',
		'full_base' => true
	)
);
?>
