<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>

	<title>
		<?php echo $title_for_layout; ?>
	</title>

	<?php
		echo $this->Html->meta( 'icon' );
		
		echo $this->Html->css( 'cakephp/cake.generic.css' );
		echo $this->Html->css('admin/admin_area');

		 //JQUERY FANCYBOX CSS!
		echo $this->Html->css( 'fancybox/jquery.fancybox.css' );

		echo $this->fetch( 'meta' );
		echo $this->fetch( 'css' );
		echo $this->fetch( 'script' );
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<?php if( $this->Session->read( 'Auth.User' ) ): ?>
				<!--Admin menu -->
				<div id="admin-menu-box">
					<ul class="admin-menu">
						<li>
							<?php
								/**
								*Admin USERS menu link.
								*/
								echo $this->Html->link(__('FELHASZNÁLOK'),
							    array(
							        'controller' => 'users',
							        'action' => 'index',
							        'admin' => true
							    ));   
							?>
								<ul>
									<li>
										<?php
											echo $this->Html->link(__('TÖRÖLT'),
								    			array(
								        			'controller' => 'users',
								        			'action' => 'show_delete',
								        			'admin' => true
								    			));
										?>
									</li>
								</ul> 
						</li>
						<!--Admin HIRDETESEK legordulo -->
						<li class="listing-menu">
							<?php
								echo $this->Html->link(__('HIRDETÉSEK'),
								    array(
								        'controller' => 'listings',
								        'action' => 'index',
								        'admin' => true
								    )
							    );
							?>
							<!--SUB MENU -->
							<ul class="listings-sub-menu">
								<li>
									<?php
										echo $this->Html->link(__('Aktiv'),
											array(
												'controller' => 'listings',
												'action' => 'activ_listings'
											)
										);
									?>
								</li>
								<li>
									<?php
										echo $this->Html->link(__('Inaktiv'),
											array(
												'controller' => 'listings',
												'action' => 'inaktiv_listings'
											)
										);
									?>
								</li>
							</ul>
						</li>

						<li>
							<?php
								/*
								*Admind highlight
								*/
								echo $this->Html->link(__('KIEMELÉSEK'),
									array(
										'controller' => 'highlights',
										'action' => 'highlight',
										'admin' => true
									)
								);
							?>
						</li>

						<li>
							<?php
								echo $this->Html->link(__('PANASZOK'),
									array(
										'controller' => 'connections',
										'action' => 'page_error',
										'admin' => true
									)
								);
							?>
						</li>

					</ul> <!--End the navigation list -->	
				</div>

				<div class="logout">
					<?php echo $this->element( 'layout/admin/admin_logout' ); ?>
				</div>
			<?php endif; ?>
		</div>
			<div id="content">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Session->flash( 'auth' ); ?>

				<?php
					/**
					*Render the view
					*/
					echo $this->fetch( 'content' );
				?>
			</div>
		<!-- Admin area footer -->
		<div id="footer"></div>
	</div>
	<?php echo $this->element( 'layout/default/js_list' ); ?>
</body>
</html>
