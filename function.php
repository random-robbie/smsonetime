<?php
######################################################
# function.php by Robert Wiggins				     #
#													 #
# questions or donate txt3rob@gmail.com				 #
######################################################
function header2()
{
echo '
<html> 
   <head> 
      <meta name="viewport" content="width=device-width, initial-scale=1"> 
          <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
          <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
          <script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
          </head> 
        <body>
<br>';
}

function footer2()
{
        echo '
                
                </div>
        </body>
</html>';
}

function loggedin()
{
// At the top of the page we check to see whether the user is logged in or not 
    if(empty($_SESSION['user'])) 
    { 
        // If they are not, we redirect them to the login page. 
        header("Location: login.php"); 
         
        // Remember that this die statement is absolutely critical.  Without it, 
        // people can view your members-only content without logging in. 
        die("Redirecting to login.php"); 
    } 
     
    // Everything below this point in the file is secured by the login system 
     

	}
	


// If user has just registered redirect to sms.php
function is_active ($user)
{
GLOBAL $db;
$sth = $db->prepare('SELECT * FROM users WHERE username = :username ');
	$sth->bindParam(':username', $user);
	$sth->execute();
	while($row = $sth->fetch(PDO::FETCH_ASSOC))
{
    if ($row['active'] == "0") {
	header('location: sms.php');
}
}
}
function active_level ($user)
{
GLOBAL $db;
$sth = $db->prepare('SELECT * FROM users WHERE username = :username ');
	$sth->bindParam(':username', $user);
	$sth->execute();
	$row = $sth->fetch(PDO::FETCH_ASSOC);
	$level = $row['active'];
	return $level;

}

function sendsms ($smskey,$number,$message)
{
    //leave var blank for using real credit or put value as 1 to test
	$test = "";
	
	// SMS Variables
	$smsid = "Member";  // Sender id for sms
	$tlhash = '';  // Textlocal API hash
	$tlusername = ''; // Textlocal Username or Email address
	

 
	// Prepare data for POST request
	$data = array('username' => $tlusername, 'hash' => $tlhash, 'numbers' => $number, "sender" => $smsid, "message" => $message, "test" => $test);
 
	// Send the POST request with cURL
	$ch = curl_init('https://api.txtlocal.com/send/');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	
	// Process your response here
	$json = json_decode($response, true);
    $sent = $json['status'];
	if ($sent === "success"){
	header ('location: sms.php?confirm=yes');
	} else {
	header ('location: sms.php?error=api');
	}

	
	



}
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}




?>