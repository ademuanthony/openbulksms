<Center><h2>PHP Test Email Script</h2></center>
<?php
// display form if user has not clicked submit
if (!isset($_POST["submit"])) {
  ?>
  <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" target="_blank">
<Table align = center>

  <tr><td>From Email: <td><input type="text" name="uname"> i.e yourname@yourdomain.com</tr>
  <tr><td>Email Password: <td><input type="password" name="pass"></tr>
<tr><td>Host: <td><input type="text" name="host"> i.e Mail.YourDomain.com</tr>
 <tr><td>To:<td> <input type="text" name="to"></tr>

  <tr><td colspan =2 align = center><input type="submit" name="submit" value="Send Email"></tr>
</table>
  </form>

  <?php 
} 
else {    // the user has submitted the form

include("class.phpmailer.php"); //you have to upload class files "class.phpmailer.php" and "class.smtp.php"
 
$mail = new PHPMailer();
 
$mail->IsSMTP();
$mail->SMTPAuth = true;

$mail->Host = $_POST["host"];

$mail->Username = $_POST["uname"];
$mail->Password = $_POST["pass"]; 
 
$mail->From = $_POST["uname"];
$mail->FromName = "demouser";
 
$mail->AddAddress($_POST["to"],"test");
$mail->Subject = "This is the subject";
$mail->Body = "This is a sample message using SMTP authentication";
$mail->WordWrap = 50;
$mail->IsHTML(true);
$str1= "gmail.com";
$str2=strtolower($_POST["uname"]);
If(strstr($str2,$str1))
{
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
if(!$mail->Send()) {
echo "Mailer Error: " . $mail->ErrorInfo;
echo "<br><br> * Please double check the user name and password to confirm that both of them are correct. <br><br>";
echo "* If you are the first time to use gmail smtp to send email, please refer to this link :http://www.smarterasp.net/support/kb/a1546/send-email-from-gmail-with-smtp-authentication-but-got-5_5_1-authentication-required-error.aspx?KBSearchID=137388";
} 
else {
echo "Message has been sent";
}
}
else{
	$mail->Port = 25;
	if(!$mail->Send()) {
echo "Mailer Error: " . $mail->ErrorInfo;
echo "<br><BR>* Please double check the user name and password to confirm that both of them are correct. <br>";
} 
else {
echo "Message has been sent";
}
}  
}
?>











