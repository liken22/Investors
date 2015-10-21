<?php
include 'config/config.php';
include 'config/functions.php';

if ($_POST['Submit']=='Submit Changes')
{
$UID = $_POST['UID'];
$id_broker = 'none';

$sql="UPDATE 1000_investor_information SET inv_prefix = '$_POST[inv_prefix]', id_number = '$_POST[inv_email]', inv_lastname = '$_POST[inv_lastname]', inv_firstname = '$_POST[inv_firstname]', inv_address = '$_POST[inv_address]', inv_city = '$_POST[inv_city]', inv_zip = '$_POST[inv_zip]', inv_state = '$_POST[inv_state]', inv_company = '$_POST[inv_company]', inv_phone = '$_POST[inv_phone]', inv_email = '$_POST[inv_email]' WHERE UID = '$UID'";

if (!mysql_query($sql,$dbhandle))
  {
  die('Error: ' . mysql_error());
  }

header('Location: admin_info.php');
exit();
}

if ($_POST['Cancel']=='Cancel')
{
header('Location: admin_info.php');
exit();
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>::..Individual Application..::</title>
<meta name="description" content="Corporate Merchant Solutions is offering free credit card terminal with rates as low as 1.03% and 10 cents a transaction.  Accept Credit Card Payments now with online Merchant Accounts." />
<meta name="keywords" content="Accept credit cards, Merchant account, Internet merchant account, Online merchant account, Merchant services, Accept credit cards online, Accept credit card payments, Accept credit card payments online, Accept credit cards now, Charge card machine" />
<meta name="distribution" content="global" />

<script language="javascript" type="text/javascript" src="js/mootools-1.2-core.js"></script>
<script language="javascript" type="text/javascript" src="js/mootools-1.2-more.js"></script>
<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	.png_img {behavior:url(iepngfix.htc);}
</style>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />

<script language="JavaScript">
  function showhidefield()
  {
    if (document.frm.chkbox.checked)
    {
      document.getElementById("hideablearea").style.display = "block";
    }
    else
    {
      document.getElementById("hideablearea").style.display = "none";
    }
  }
</script>
<!--script to reset form with radio click-->
<script type="text/javascript">
<!--
function clearValues(f){
for(i=0; i<f.elements.length-1; i++){
if ((f.elements[i].type)=="submit"){}
else if((f.elements[i].type)=="button"){}
else{
f.elements[i].value="";
}
}
}
//-->
</script>

<script type="text/javascript">
<!--
function formValidator(){
	// Make quick references to our fields
	var inv_lastname = document.getElementById('inv_lastname');
	var inv_firstname = document.getElementById('inv_firstname');
	var inv_phone = document.getElementById('inv_phone');
	var inv_email = document.getElementById('inv_email');
	
	// Check each input in the order that it appears in the form!
	if(notEmpty(inv_lastname, "Please Enter a Value for Last Name")){
		if(notEmpty(inv_firstname, "Please Enter a Value for First Name")){
			if(notEmpty(inv_phone, "Please Enter a Value for Phone")){
				if(notEmpty(inv_email, "Please Enter a Value for Email")){
							return true;
				}
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

<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
</head>

<body id="cus_application">

<div id="main">
	<div class="header">
    <table width="900" border="0" cellpadding="0">
  <tr>
    <td class="logo">
      <a href="admin.php"><img src="images/header.png" border="0" class="png_img" /></a></td>
    </tr>
</table>
  </div>
    <div class="header2">
    	<h1>Corporate Merchant Services - Investors Profile</h1>
        
  </div>
<div class="container png_img">
<?php 


$UID = $_GET['inv_UID'];
$UID = decode_this($UID);
$query = mysql_query("SELECT * FROM 1000_investor_information WHERE UID = '$UID'");
echo mysql_error();
$nt=mysql_fetch_array($query);
?>
   	
    <form action="inv_edit.php" method="post" onsubmit='return formValidator()'>
    <div class="application white_background">
    
    <div id="sub3">
    <label><b>Investor Information</b></label>
    <table width="900" border="0" cellpadding="0">
  	<tr>
    <td height="45" valign="middle" nowrap="nowrap">Prefix:</td>
    <td height="45" valign="middle" nowrap="nowrap">
    <select name="inv_prefix" id="inv_prefix">
              <?php
		// value to compare with database 
		select_prefix($nt[inv_prefix]);
	  ?>  
      </select>    </td>
    <td height="45" valign="middle" nowrap="nowrap">Last Name*:</td>
    <td height="45" valign="middle" nowrap="nowrap"><span id="sprytextfield1">
      <input name="inv_lastname" type="text" class="fieldset" value="<? echo "$nt[inv_lastname]"?>" id="inv_lastname" tabindex="2" maxlength="128" />
      <span class="textfieldRequiredMsg">Last Name is Required</span></span></td>
    <td height="45" colspan="2" valign="middle" nowrap="nowrap">First Name*:</td>
    <td height="45" colspan="3" valign="middle" nowrap="nowrap"><span id="sprytextfield2">
      <input name="inv_firstname" type="text" class="fieldset" value="<? echo "$nt[inv_firstname]"?>" id="inv_firstname" tabindex="3" maxlength="50" />
      <span class="textfieldRequiredMsg">First Name is Required</span></span></td>
  	</tr>
 	 
      <tr>
    <td height="45" valign="middle" nowrap="nowrap"> Address:</td>
    <td height="45" valign="middle" nowrap="nowrap">
      <input name="inv_address" type="text" class="fieldset" value="<? echo "$nt[inv_address]"?>" id="inv_address" tabindex="5" maxlength="50" />      </td>
      <td height="45" valign="middle" nowrap="nowrap">City:</td>
    <td height="45" valign="middle" nowrap="nowrap">
      <input name="inv_city" type="text" class="fieldset" value="<? echo "$nt[inv_city]"?>" id="inv_city" tabindex="6" maxlength="25" />      </td>
    <td height="45" valign="middle" nowrap="nowrap">Zip Code:</td>
    <td height="45" valign="middle" nowrap="nowrap"><span id="sprytextfield5">
    <input name="inv_zip" type="text" class="fieldset" value="<? echo "$nt[inv_zip]"?>" id="inv_zip" size="5" tabindex="7" maxlength="5" />
    <span class="textfieldInvalidFormatMsg">Only Numbers</span><span class="textfieldMaxCharsMsg">5 Digits Zip Code</span></span></td>
    <td height="45" valign="middle" nowrap="nowrap">State:</td>
    <td height="45" valign="middle" nowrap="nowrap">
      <select name="inv_state" id="inv_state">
              <?php
		// value to compare with database 
		select_state($nt[inv_state]);
	  ?>  
      </select>     </td>
      </tr>
  <tr>
    <td height="45" valign="middle" nowrap="nowrap">Company:</td>
    <td height="45" valign="middle" nowrap="nowrap">
    <input name="inv_company" type="text" class="fieldset" value="<? echo "$nt[inv_company]"?>" id="inv_company" tabindex="8" maxlength="128" />    </td>
    <td height="45" valign="middle" nowrap="nowrap">Phone*:</td>
    <td height="45" valign="middle" nowrap="nowrap"><span id="sprytextfield8">
    <input name="inv_phone" type="text" class="fieldset" value="<? echo "$nt[inv_phone]"?>" id="inv_phone" tabindex="9" maxlength="14" />
    <span class="textfieldRequiredMsg">Phone is required.</span></span></td>
    <td height="45" colspan="2" valign="middle" nowrap="nowrap">Email*:</td>
    <td height="45" colspan="3" valign="middle"><span id="sprytextfield9">
    <input name="inv_email" type="text" class="fieldset" value="<? echo "$nt[inv_email]"?>" id="inv_email" tabindex="10" maxlength="50" />
    <span class="textfieldRequiredMsg">Email is Required</span><span class="textfieldInvalidFormatMsg">Invalid Email Address</span></span></td>
    </tr>
  <tr>
    <td height="20" colspan="9" valign="middle" nowrap="nowrap"  class="text10"><em>(*) Requiered Field</em></td>
    </tr>
</table>
</div>
<!--</form>
<form>-->

<div id="sub5">
    
  
      <div align="center">
     
     <table width="900" border="0" cellpadding="0">
     <tr>
     <td align="center">
     
    
     <div align="center" id="btn_individual">
     <input type="hidden" name="UID" id="UID" value="<? echo "$UID" ?>"/>
     	<input name="Cancel" type="submit" value="Cancel" /><img src="images/space.png" width="30" height="10" />
         <input name="Submit" type="submit" value="Submit Changes"/>
     </div>
    
     
     
     </td>
     </tr>
     </table>
     
   
     </div>
   </div>
   </div> <!--div application-->
    </form>
     
  </div>
  
   
      
 
  
<?php include("Includefooter.html"); ?>
</div> 


<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-8779699-5");
pageTracker._trackPageview();
} catch(err) {}
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "zip_code", {validateOn:["blur"], isRequired:false});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "none", {validateOn:["blur"]});
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "email", {validateOn:["blur"]});
</script>
</body>
</html>
