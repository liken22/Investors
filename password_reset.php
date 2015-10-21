<?php
include 'config/config.php';
include 'config/functions.php';

$user = $_POST['id_number'];

if ($_POST['doLogin']=='Send')
{
$query = mysql_query("SELECT * FROM 1000_investor_information WHERE id_number = '$user'");
echo mysql_error();
$nt=mysql_fetch_array($query);
$UID = $nt[UID];
$email = $nt[inv_email];
$firstname = $nt[inv_firstname];
$lastname = $nt[inv_lastname];
$inv_prefix = $nt[inv_prefix];

if (mysql_num_rows($query)== 0){
$msg = "Invalid Email. <br />Please verify your information<br />and try again.";
header("Location: password_reset.php?msg=$msg");
exit();
}else{
// reset password and send email

function createRandomPassword() {
    $chars = "abcdefghijkmnopqrstuvwxyz023456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;
    while ($i <= 7) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
}

$new = createRandomPassword();

//send email with new password to user

$mailto = "$email";
$mail = "ir@cmsimail.com";

$message = "$inv_prefix $firstname $lastname

Your Password has been reset.

Your New Password is $new

Thank you.

";

$headers.= "From: $mail\r\n" ;
$headers.= "Bcc: raulfernandez@cmsimail.com\r\n";
$headers.= "Content-Type: text/plain;";

$r = mail("$mailto", "Investor New Password", "$message", $headers);

// change the password in the database

$sql="UPDATE 1000_investor_information SET password = '$new' WHERE id_number = '$user'";
				
if (!mysql_query($sql,$dbhandle)){
die('Error: ' . mysql_error());
}else{
$msg = "Your Information has been Succesfully Changed. Please check your email";
header("Location: password_reset.php?msg=$msg");
exit();
}
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {
padding-top:10px;}

.style5 {
	color: #FFFFFF;
	font-size: 10px;
	text-align: left;
}
body {
	background-color: #666666;
}

-->
</style>


<script type="text/javascript">
<!--
function formValidatorLogin(){
	// Make quick references to our fields
	var user_id = document.getElementById('id_number');
	
	// Check each input in the order that it appears in the form!
	if(notEmpty(user_id, "Please Enter a Value for User")){
							return true;
	}
	return false;
}


function notEmpty(elem, helperMsg){
	if(elem.value.length == 0){
		alert(helperMsg);
		elem.focus(); // set the focus to this input
		return false;
	}
	return true;
}

//-->
</script>
</head>

<body>
<div style="width:205px; background-color:#666666" class="png_img fleft indented_15 ">
<br />
<div class="block1_top">
            <b>Password Reset</b>
          </div>
          <form style="width:205px" action="password_reset.php" method="post" onsubmit='return formValidatorLogin()' >
            <div class="block1_mid png_img">
              
                <p>Username (email)<br/>
                	<input name="id_number" type="text" size="20"  id="id_number" tabindex="1"/> 
              </p>
              
                
              <div align="center">
                <input name="doLogin" type="submit" id="doLogin" value="Send" /><img src="images/space.png" width="10" height="4" /> <?php
echo '<BUTTON onclick="window.close();">Close</BUTTON>';
?>
             </div>
          </div>
          </form>
          <div class="block1_but png_img">
          </div>
          <div style="width:205px" class="style5">
  
	  <?
	  /******************** ERROR MESSAGES*************************************************
	  This code is to show error messages 
	  **************************************************************************/
      if (isset($_GET['msg'])) {
	  $msg = mysql_real_escape_string($_GET['msg']);
	  echo "<div class=\"msg\">$msg</div>";
	  }
	  /******************************* END ********************************/	  
	  ?>  
      </div> 


</div>


</body>
</html>