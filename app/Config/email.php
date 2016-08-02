<?php

class EmailConfig 
{
	public $default = array(
		'transport' => 'Mail',
		'from' => 'you@localhost',
		//'charset' => 'utf-8',
		//'headerCharset' => 'utf-8',
	);

	public $smtp = array(
		'transport' => 'Smtp',
		'from' => array( 'kataitibor1990@gmail.com' => 'My Site' ), // An array containing the "from" address and sender name
		'host' => 'localhost', // Add your SMTP mail server here
		'port' => 25, // Port your outgoing mail should be sent via. 25 is normally fine for SMTP, but may be different for some mail services
		'timeout' => 30,
		'username' => 'kataitibor1990@gmail.com',  // The username for my account
		'password' => 'nokiAn73',  // The password for my account
		'client' => null,
		'log' => false,  // Log the email headers and message
		'charset' => 'utf-8',
		'headerCharset' => 'utf-8',
	);

	public $fast = array(
		'from' => 'you@localhost',
		'sender' => null,
		'to' => null,
		'cc' => null,
		'bcc' => null,
		'replyTo' => null,
		'readReceipt' => null,
		'returnPath' => null,
		'messageId' => true,
		'subject' => null,
		'message' => null,
		'headers' => null,
		'viewRender' => null,
		'template' => false,
		'layout' => false,
		'viewVars' => null,
		'attachments' => null,
		'emailFormat' => null,
		'transport' => 'Smtp',
		'host' => 'localhost',
		'port' => 25,
		'timeout' => 30,
		'username' => 'user',
		'password' => 'secret',
		'client' => null,
		'log' => true,
		//'charset' => 'utf-8',
		//'headerCharset' => 'utf-8',
	);

	public $gmail = array(
		'host' => 'ssl://smtp.gmail.com',
		'port' => 465,
		'username' => 'kataitibor1990@gmail.com',
		'password' => 'nokiAn73',
		'transport' => 'Smtp',
		'timeout' => 30
	);
}
