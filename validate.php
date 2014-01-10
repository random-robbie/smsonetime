<?php

require_once('common.php');
require_once('function.php');
loggedin();
if (isset($_POST['number'])){
$number = $_POST['number'];
$userid = $_POST['user'];

//Check Number Length
$count = strlen($number);
if ($count != "11" ) {
header ('location: sms.php?error=shortnum');
}
// Check Number Starts with 07
if (!preg_match('/^07/', $number))
{
header ('location: sms.php?error=startnum');
}
// Grab the verified Code to send to user.
GLOBAL $db;
$sth2 = $db->prepare('SELECT * FROM users WHERE id = :userid ');
$sth2->bindParam(':userid', $userid);
$sth2->execute();
$row2 = $sth2->fetch();
$smskey = $row2['smskey'];
$message = 'Your SMS Verification Code: '.$smskey.'';  // SMS message that is sent to the user
sendsms ($smskey,$number,$message);
}

if (isset($_POST['code']))
{
// confirm verified code
GLOBAL $db;
$code = $_POST['code'];
$sth3 = $db->prepare('SELECT * FROM users WHERE smskey = :smskey ');
$sth3->bindParam(':smskey', $code);
$sth3->execute();
$count = $sth3->rowCount();
if ($count == "0") {
header ('location: sms.php?error=wrong');
die();
} else {
$sth4 = $db->prepare('UPDATE users SET active = 1 WHERE smskey = :smskey ');
$sth4->bindParam(':smskey', $code);
$sth4->execute();
header ('location: private.php');
die();
}
}




?>