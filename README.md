SMS ONE TIME
-------------


This is a private members script.

The login is nice and secure and members can only access the site if they hold a valid mobile number.

It will text them a one time code to access the site and then allow them to view the private.php file's contents.

No Mobile numbers are stored in the database so you do not have to worry if you server gets hacked some other way.

It is based on a how to from [here] (http://forums.devshed.com/php-faqs-and-stickies-167/how-to-program-a-basic-but-secure-login-system-using-891201.html)

I have intergrated textlocal to send the SMS but you can easily alter this in the functions file.



Edit the common.php file to enter your mysql details and in functions.php fill in your textlocal account details.

Don't forget to import the users.sql file!

tested on lighthttpd but apache should work fine.



To Do:
-----

Make Errors show up correctly.
