<?php
//define an always working path to sources with trailing Slash "/"
define('URL', 'http://192.168.1.14/Socialize/');
//define an MAIL address from where mails should be sended. Below is an example.
define('MAIL', 'noreply@Socialize.eu');
//define the site and secret key for reCAPTCHA.
define('SITEKEY', 'Your Site key');
define('SECRETKEY', 'Your Secret key');

require '../private/security.php'; // This file contains the credentials for the database, this should be secure in a different directory
