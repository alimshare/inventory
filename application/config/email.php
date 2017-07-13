<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

## GMAIL ##
// $config['protocol'] 	= 'smtp';
// $config['smtp_host'] 	= 'smtp.googlemail.com';//'ssl://smtp.googlemail.com';
// $config['smtp_port'] 	= '587';//'465';

// $config['smtp_user'] 	= 'test@gmail.com';
// $config['smtp_pass'] 	= '***';
// #$config['smtp_crypto'] 	= 'security';

// $config['mailtype'] 	= 'html'; // text or html
// $config['newline']		= "\r\n";
// $config['crlf']         = "\r\n";
#$config['charset']      = 'utf-8';

## OTHER ##
$config['protocol'] 	= 'smtp';
$config['smtp_host'] 	= 'inventory.bantuanteknis.org';
$config['smtp_port'] 	= '25';

$config['smtp_user'] 	= 'noreply@inventory.bantuanteknis.org';
$config['smtp_pass'] 	= 'p@ssw0rd2017';

$config['mailtype'] 	= 'html'; // text or html
$config['newline']		= "\r\n";


/* End of file email.php */
/* Location: ./application/config/email.php */