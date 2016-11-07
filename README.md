# Socialize

In this project I'm going to try to make a social website of any kind, users should be able to register,
log in and make posts on the 'dashboard'. Later on I want to try to give users the option to reply on posts,
and to mark posts as favourite in case something useful is in there ;).

This project is going to be made in an MVC structure based on PHP and a bit jQuery to give errors on the client-side.

**Before using and/or changing anything of this project, please read the license!**

## Current state:
![Index page](http://imgur.com/7rR6qH3.png) 

## License
[Socialize License](LICENSE)

## Installation
* Clone this repository
* Change the security file: 'Socialize/security.php' , with your own credentials and databasename.
* Connect to your sql server and create a database.
* Add the necessery tables by copying the code in the 'Socialize/tables.sql' file or import this file.
* Move the Socialize/security.php file to ../private , make this directory first!  _or place it somewhere different and change the location in the config file_
* Change the config file: 'Socialize/config.php' , with your own URL and e-mail address.
* To set the SITEKEY and SECRETKEY in the config file you have to create a google reCAPTCHA API: https://www.google.com/recaptcha/admin#list _It is required to have a google account_
* Create your API keys by registering your domain and copy your "Site key".
* Replace "Your Site key" in the config file.
* Copy your "Secret Key" from recaptcha and replace "Your Secret key" in the config file. ;)

The website and Recaptcha should now work fine 😄, more info about reCAPTCHA can be found here: https://developers.google.com/recaptcha/
