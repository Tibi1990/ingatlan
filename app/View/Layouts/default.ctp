<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic' rel='stylesheet' type='text/css'>
	<?php $this->Html->script('https://maps.google.com/maps/api/js?sensor=true', false); ?>
	<?php
		echo $this->element( 'layout/default/css_list' );
	?>
	<script src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
</head>

<body>
	<div class="navbar navbar-inverse navbar-static-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
				<div id="header-logo">
					<?php
						echo $this->Html->link(__( 'Alberlet' ),
							'/' ,
							array(
								'class'=>'navbar-brand'
						)   );
					?>
				</div>
			</div>

			<div class="collapse navbar-collapse">
				<?php echo $this->element( 'layout/default/header_nav_bar' ); ?>
			</div>
		</div>
	</div>
	
	<div class="container">
		<?php
			if( $this->Session->check( 'Auth.User' ) )
			{ 
				echo $this->element('layout/loginbox');
			}
		 
			echo $this->Session->flash(); 
			echo $this->Session->flash( 'auth' );
		
		 	echo $this->fetch( 'content' ); 
	 	?>

		<div class="clear"></div>
	</div>

	<?php echo $this->element( 'layout/default/js_list' ); ?>
</body>
</html>
