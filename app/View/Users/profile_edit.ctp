<!-- Profile edit information box -->
<div class="error-message" style="clear:both;padding:15px;">
	<?php echo __( '<span class="user-profile-edit-title">Saját profil szerkesztése!</span>' ); ?>
	<ol>
		<li class="line-height">
			<?php echo __('Bármelyik adatát tetszőleges megbirja változtatni.'); ?>
		</li>

		<li class="line-height">
			<?php echo __('Ha új fényképet szeretne feltölteni <b>kattintson a tallozás gombra majd válassza ki az új profil fényképét!</b>'); ?>
		</li>

		<li class="line-height">
			<?php echo __('Ha nem szeretné megváltoztattni az eredettileg megadott fényképét akkor csak a <b>profil mentése gombra kattintson!</b>'); ?>
		</li>
	</ol>
</div>

<div class="profile-edit">
<?php
	echo $this->Form->create( 'User', array(
		'type' => 'file',
		'class' => 'form-horizontal', 
		'role' => 'form',
		'inputDefaults' => array(
			'format' => array( 'before', 'label', 'between', 'input', 'error', 'after' ),
			'div' => array( 'class' => 'form-group' ),
			'class' => array( 'form-control' ),
			'label' => array( 'class' => 'col-lg-2 control-label' ),
			'between' => '<div class="col-md-7">',
			'after' => '</div>',
			'error' => array( 'attributes' => array( 'wrap' => 'span', 'class' => 'help-inline' ) )
	))); 

	echo $this->Form->input( 'username', array(
		'label' => false
	));

	echo $this->Form->input( 'fullname', array(
		'label' => false
	));

	echo $this->Form->input( 'email', array(
		'label' => false
	));

	echo $this->Form->input( 'phone', array(
		'label' => false
	));
?>
	<div class="error-message">
		<?php echo __('<u><b>Töltsd fel magadról a kedvenc fényképed!</b></u>'); ?>
		<ol>
			<li class="line-height">Kötelező a képfeltöltés</li>
			<li class="line-height">Profil modositásánál kötelező az ujboli képfeltöltés!!</li>
		</ol>
	</div>

<?php
	echo $this->Form->input('User.user_photo', array(
		'type' => 'file',
		'label' => false,
		'div' => false,
		'class' => 'user-profile-photo'

	));

	echo '<div class="clear"></div>';
					
	echo $this->Form->button(__( 'Profil mentése' ), array(
		'class' => 'btn btn-danger',
		'id' => 'btn-danger'	
	) );

	echo $this->Form->end();
?>

</div>