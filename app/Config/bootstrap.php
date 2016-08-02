<?php

/**
*Cakephp default configuration begin
*/
Cache::config( 'default', array('engine' => 'File') );

Configure::write( 'Dispatcher.filters', array(
	'AssetDispatcher',
	'CacheDispatcher'
) );

/**
 * Configures default file logging options
 */
App::uses( 'CakeLog', 'Log' );

CakeLog::config( 'debug', array(
	'engine' => 'File',
	'types' => array( 'notice', 'info', 'debug' ),
	'file' => 'debug',
) );

CakeLog::config( 'error', array(
	'engine' => 'File',
	'types' => array( 'warning', 'error', 'critical', 'alert', 'emergency' ),
	'file' => 'error',
) );

/****************************************************************************
*Cakephp default configuration end
*****************************************************************************/

/****************************************************************************
*Cakephp plugins begin
*****************************************************************************/

CakePlugin::load( 'Recaptcha' ); // https://github.com/CakeDC/recaptcha
CakePlugin::load( 'DebugKit' ); // https://github.com/Debugkit

/****************************************************************************
*Cakephp plugins end
*****************************************************************************/

/****************************************************************************
*Cakephp myself congiguration
*****************************************************************************/

Configure::write( 'App.defaultEmail', 'kataitibor1990@gmail.com' );

Configure::write( 'Recaptcha.publicKey', '6LcZffMSAAAAABGZsQdNgs5W9hk8n1gX40kfZ1K8' );
Configure::write( 'Recaptcha.privateKey', '6LcZffMSAAAAAPa9HDeFCRrZ0sdiIOx3H0UiSJIA' );

/******************************************************************************
*Cakephp myself congiguration end
*******************************************************************************/

/******************************************************************************
*Cakephp tranlate language start
*******************************************************************************/

Configure::write( 'Config.language', 'en' );


/*******************************************************************************
*Cakephp tranlate language end
********************************************************************************/
