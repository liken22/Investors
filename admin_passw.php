<?php
include 'config/config.php';
include 'config/functions.php';

session_start();

if (isset($_SESSION['UID'])) {
$UID = $_SESSION['UID'];
}else{
$msg = "Please Login Here.";
header("Location: index.php?msg=$msg");
}


$query = mysql_query("SELECT * FROM 1000_investor_admin WHERE UID = '$UID'");
echo mysql_error();
$nt=mysql_fetch_array($query);
$UID = $nt[UID];
$password = $nt[password];

if ($_POST['confirm_password']=='Change')
{
	$old = $_POST['old_password']; //get info from form
	$new = $_POST['new_password']; 
	$new_confirmation = $_POST['new_password_confirmation'];//get info from form
		if ($old != $password){
			$msg = "Invalid Password. <br />Please Verify that your Old Password is correct.";
			header("Location: admin_passw.php?msg=$msg");
			exit();
		}else{
			if ($new != $new_confirmation){
				$msg = "Invalid Password. <br />Please Verify that your New Password and Your Confirmation Password are correct.";
				header("Location: admin_passw.php?msg=$msg");
				exit();
			}else{
				$sql="UPDATE 1000_investor_admin SET password = '$new' WHERE UID = '$UID'";
				
				if (!mysql_query($sql,$dbhandle)){
				  die('Error: ' . mysql_error());
				  }else{
				  $msg = "Your Information has been Succesfully Changed";
				header("Location: admin_passw.php?msg=$msg");
				exit();
				  }
				
			}
		}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>::..Confirmation Form..::</title>
<meta name="description" content="Corporate Merchant Solutions is offering free credit card terminal with rates as low as 1.03% and 10 cents a transaction.  Accept Credit Card Payments now with online Merchant Accounts." />
<meta name="keywords" content="Accept credit cards, Merchant account, Internet merchant account, Online merchant account, Merchant services, Accept credit cards online, Accept credit card payments, Accept credit card payments online, Accept credit cards now, Charge card machine" />
<meta name="distribution" content="global" />

<script language="javascript" type="text/javascript" src="js/mootools-1.2-core.js"></script>
<script language="javascript" type="text/javascript" src="js/mootools-1.2-more.js"></script>
<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.png_img {behavior:url(iepngfix.htc);}

.style5 {
color: #CC0000;
font-size: 14px;
text-align: left;
font-weight: bold;
}
</style>

<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>

<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
<!--

function formValidator(){
	// Make quick references to our fields
	var old_pass = document.getElementById('old_password');
	var new_pass = document.getElementById('new_password');
	var new_pass_conf = document.getElementById('new_password_confirmation');
	// Check each input in the order that it appears in the form!
	if(notEmpty(old_pass, "Please Enter a Value for Old Password")){
		if(notEmpty(new_pass, "Please Enter a Value for New Password")){
			if(notEmpty(new_pass_conf, "Please Enter a Value for New Password Confirmation")){
							return true;
			}
		}
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

<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" /></head>

<body id="cus_application">



<div id="main">
	<div class="header">
    <table width="900" border="0" cellpadding="0">
  <tr>
    <td class="logo">
      <a href="index.php"><img src="images/header.png" border="0" class="png_img" /></a></td>
    </tr>
</table>
  </div> <!--header-->
  <!--header2-->
<div class="container">
       
    
    <div class="application white_background">
    

<div class="fleft"><b>Welcome <? echo "$nt[admin_firstname]"?>&nbsp;<? echo "$nt[admin_lastname]"?></b></div>
<div class="clear"></div>
    
    <div class="fright link_marron"><a href="logout.php">Log out</a></div>
      <table width="900" border="0" cellpadding="0">
      <tr>
          <td height="32" colspan="2" align="left">
          <img src="images/space.png" width="5" height="4" class="img_floatleft" />
<div class="btn_120"><span onmouseover="this.style.color='red';" onmouseout="this.style.color='black';"><a class="btn_text_black" href="admin_passw.php">Main Page</a></span></div><br />
<br />
<hr /></td>
        </tr>
      <tr>
        <td width="219" height="45" valign="top">Old Password:<br />
<br />
New Password:<br />
<br />
New Password Confirmation:</td>
        <td width="675" height="45" align="left">
        <form method="post" action="admin_info.php" onsubmit='return formValidator()'>
        	<input type="text" name="old_password" id="old_password" /><br /><br />
            <input type="password" name="new_password" id="new_password" /><br /><br />
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" />
            <br /><br />
            <input type="submit" name="confirm_password" id="confirm_password" value="Change"/>
        </form> <br />
        <div class="style5">
  
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
 </td>
      </tr>
        <tr>
          <td height="32" colspan="2" align="left"><hr /></td>
        </tr>
        </table>

   
   </div> <!--div application-->

     
  </div> <!--container-->
  
   
      
<!-- Footer----------------------->
  
<?php include("Includefooter.html"); ?>

<!-- main-->

</div>
</body>
</html>