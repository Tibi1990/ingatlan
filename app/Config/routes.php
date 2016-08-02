<?php

/*************************************
**************************************
*STATIC PAGES START
**************************************
**************************************/
Router::connect(
	'/bemutatkozas',
	array(
		'controller' => 'pages',
		'action' => 'about',
		'admin' => false
	),
	array(
		'id' => '[0-9]+'
	)
);

/*************************************
**************************************
*ADMIN ROUTES START
**************************************
**************************************/

/**
*ADMIN USERS ROUTES
*/
Router::connect(
	'/admin',
	array(
		'controller' => 'users',
		'action' => 'login',
		'admin' => true
	),
	array(
		'id' => '[0-9]+'
	)
);

/**
*ADMIN USERS ROUTES
*/
Router::connect(
	'/admin/index', 
	array(
		'controller' => 'users',
		'action' => 'index',
		'admin' => true
	),
	array(
		'id' => '[0-9]+'
	)
);

/**
*ADMIN USERS ROUTES
*/
Router::connect(
	'/admin/hozzaadas', 
	array(
		'controller' => 'users',
		'action' => 'add',
		'admin' => true
	),
	array(
		'id' => '[0-9]+'
	)
);

/**
*ADMIN USERS ROUTES
*/
Router::connect(
	'/admin/megtekintes/*', 
	array(
		'controller' => 'users',
		'action' => 'view',
		'admin' => true
	),
	array(
		'id' => '[0-9]+'
	)
);

/**
*ADMIN USERS ROUTES
*/
Router::connect(
	'/admin/szerkesztes/*', 
	array(
		'controller' => 'users',
		'action' => 'edit',
		'admin' => true
	),
	array(
		'id' => '[0-9]+'
	)
);

/**
*ADMIN LISTINGS ROUTES
*/

/*************************************
**************************************
*USERS ROUTES START
**************************************
**************************************/
Router::connect('/',
	array(
		'controller' => 'users',
		'action' => 'index',
		'admin' => false
	),
	array(
		'id' => '[0-9]+'
	)
);
	
Router::connect(
	'/regisztracio',
	array(
		'controller' => 'users',
		'action' => 'registration',
		'admin' => false
	),
	array(
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/bejelentkezes',
	array(
		'controller' => 'users',
		'action' => 'login',
		'admin' => false
	),
	array(
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/profil',
	array(
		'controller' => 'users',
		'action' => 'userProfile'
	),
	array(
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/profil_szerkesztes',
	array(
		'controller' => 'users',
		'action' => 'profile_edit'
	),
	array(
		'id' => '[0-9]+'
	)
);

/*************************************
**************************************
*LISTINGS ROUTES START
**************************************
**************************************
*/
Router::connect(
	'/hirdeteskezeles',
	array(
		'controller' => 'listings',
		'action' => 'index',
		'admin' => false
	),
	array(
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/hirdetesfeladas',
	array(
		'controller' => 'listings',
		'action' => 'listingAdd',
		'admin' => false
	),
	array(
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/hirdetesmodositas',
	array(
		'controller' => 'listings',
		'action' => 'edit'
	),
	array(
		'id' => '[0-9]+',
		'pass' => array( 'id' )
	)
);

Router::connect(
	'/hirdetesmegtekintes/:id',
	array(
		'controller' => 'users',
		'action' => 'listings_proces'
	),
	array(
		'id' => '[0-9]+',
		'pass' => array( 'id' )
	)
);

/*************************************
**************************************
*CONNECT ROUTES START
**************************************
**************************************
*/
Router::connect(
	'/kapcsolat',
	array(
		'controller' => 'connections',
		'action' => 'index',
		'admin' => false
	),
	array(
		'id' => '[0-9]+'
	)
);

/*************************************
**************************************
GENERAL ROUTES
**************************************
**************************************/

/**
*Forgott password!!
*/
Router::connect(
	'/elfelejtettjelszo',
	array(
		'controller' => 'users',
		'action' => 'forgot_password'
	),
	array(
		'id' => '[0-9]+'
	)
);

/**
*Main page search!!
*/
Router::connect( 
	'/kereses/*',
	array(
		'controller' => 'listings',
		'action' => 'search_index'
	),
	array(
		'id' => '[0-9]+',
		'named' => array(
			'page' => '[\d]+'
		),
		'pass' => 'page'
	)
);

CakePlugin::routes();

require CAKE . 'Config' . DS . 'routes.php';
