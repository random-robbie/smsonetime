<?php 

    // First we execute our common code to connection to the database and start the session 
    require_once("common.php"); 
    
	
	//ERROR MESSAGES
	$shortnum = "<strong>ERROR: Number should be 11 digits </strong>";
	$startnum = "<strong>ERROR: Number must start 07</strong>";
	$apierror = "<strong>ERROR: Please contact support SMS API error has occurred</strong>";
	$wrongsmskey = "<strong>ERROR: The key you have entered is not valid</strong>";
	
    // Is user logged in?
    loggedin();
	
	 // We can display the user's username to them by reading it from the session array.  Remember that because 
    // a username is user submitted content we must use htmlentities on it before displaying it to the user. 
	$user = $_SESSION['user']['id'];
	
	

	
function entermob() {
GLOBAL $error;
header2();
$user = $_SESSION['user']['id'];
echo'
<div data-role="page" data-theme="b" align="center"> 
      <div id="mobile"> 
        <form action="validate.php" method="post" id="numberconfirm"> 
          <h2><label>Enter Mobile Number</label></h2>
		     Mobile Number: <input type="text" name="number">
		 <input type="hidden" name="user" value="'.$user.'">
   <br><br>
   <input type="submit" name="submit" data-inline="true" value="Submit"> 
</form><div id="results">';
footer2();
}	

function entercode () {
GLOBAL $error;
header2();
echo '
<div data-role="page" id="newsms" data-theme="b" align="center"> 
      <div id="code"> 
        <form action="validate.php" method="post" id="numberconfirm"> 
          <h2><label>Enter Verification Code</label></h2>
		     Verification Code: <input type="text" name="code">
   <br><br>
   <input type="submit" name="submit" data-inline="true" value="Submit"> 
</form><div id="results">';
}

if (isset($_GET['error']) && $_GET['error'] == 'shortnum') {
entermob();
$error = $shortnum;
}
if (isset($_GET['error']) && $_GET['error'] == 'startnum') {
entermob();
$error = $startnum;
}
if (isset($_GET['error']) && $_GET['error'] == 'api') {
entermob();
$error = $apierror;
}
if (empty($_GET)) {
entermob();
}
if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
entercode();
}
if (isset($_GET['error']) && $_GET['error'] == 'wrong') {
entercode();
$error = $wrongsmskey;
}



?> 
