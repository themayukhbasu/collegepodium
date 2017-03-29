<!DOCTYPE html>
<html>
<body>

<?php
use \google\appengine\api\mail\AdminMessage;

$username=$_POST['userName'];
$useremail=$_POST['userEmail'];
$userphone=$_POST['userPhone'];
$usermsg=$_POST['userMsg'];





try 
{
$message = new AdminMessage();
$message->setSender("bhojan.caterer@gmail.com");
$message->setSubject("New Mail From ".$username);
$message->setTextBody($usermsg."\n\n\n--------------\n".$username."\n".$useremail."\n".$userphone."\n---------\n");
$message->send();
echo "thanks".$username; 
echo "\nyou will be redirected now"; 
sleep(10);
echo "<script type=\"text/javascript\">window.location.href = 'http://bhojoncaterers.appspot.com/';</script>";








}


catch (InvalidArgumentException $e){
echo "$e"."You Have not input all fields." ;
}


?>  

</body>
</html>