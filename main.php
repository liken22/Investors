<?php
session_start();

include 'config/config.php';
include 'config/functions.php';

$user = $_POST['id_number'];
$pass = $_POST['password'];

if ($_POST['doLogin']=='Login')
{
$query = mysql_query("SELECT * FROM 1000_investor_information WHERE id_number = '$user' AND password = '$pass'");
echo mysql_error();
$nt=mysql_fetch_array($query);
$UID = $nt[UID];
$_SESSION['UID'] = $UID; // store session data
if (mysql_num_rows($query)== 0){
$msg = "Invalid Login. <br />Please verify your information<br />and login again.";
header("Location: main.php?msg=$msg");
exit();
}else{
header('Location: user_info.php');
}
}


if ($_POST['FormLogin']=='Submit and Accept conditions')
{
$email = $_POST['inv_email'];
$query = mysql_query("SELECT * FROM 1000_investor_information WHERE inv_email = '$email'");
echo mysql_error();
$nt=mysql_fetch_array($query);

if (mysql_num_rows($query) > 0){
echo "<meta http-equiv='refresh' content='0;URL=main.php'>"; 
echo "<script>alert('Invalid Email. This Email is already registered, please try another.')</script>";
exit();
}

$phone = substr($_POST['inv_phone'], -4);
$code = strtolower($_POST['inv_lastname']) . $phone;
$id_broker = 'none';

$sql="INSERT INTO 1000_investor_information (UID, inv_prefix, id_number, password, id_broker, inv_lastname, inv_firstname, inv_address, inv_city, inv_zip, inv_state, inv_company, inv_phone, inv_email, initial1, nda_accept, inv_ip, inv_datetime)
 VALUES
('', '$_POST[inv_prefix]', '$_POST[inv_email]', '$code', '$id_broker', '$_POST[inv_lastname]', '$_POST[inv_firstname]', '$_POST[inv_address]', '$_POST[inv_city]', '$_POST[inv_zip]', '$_POST[inv_state]', '$_POST[inv_company]', '$_POST[inv_phone]', '$_POST[inv_email]', '$_POST[initial1]', '$_POST[nda_accept]', '$_POST[inv_ip]', '$_POST[inv_datetime]')";

if (!mysql_query($sql,$dbhandle))
  {
  die('Error: ' . mysql_error());
  }
  
$query = mysql_query("SELECT * FROM 1000_investor_information WHERE inv_lastname = '$_POST[inv_lastname]' AND inv_email = '$_POST[inv_email]'");
echo mysql_error();
$nt=mysql_fetch_array($query);

$_SESSION['UID'] = $nt[UID];
$password = $nt[password];
$email = $nt[inv_email];

sendemail_investors($email, $password);
sendemail_investors_CMS($email, $password);

header('Location: user_info.php');

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>::..Investors Application..::</title>
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
	.padd_up{
	padding-top:5px;
	}
</style>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />


<script type="text/javascript">
<!--
function formValidatorLogin(){
	// Make quick references to our fields
	var user_id = document.getElementById('id_number');
	var pass = document.getElementById('password');
	
	// Check each input in the order that it appears in the form!
	if(notEmpty(user_id, "Please Enter a Value for User")){
		if(notEmpty(pass, "Please Enter a Value for Password")){
							return true;
		}
	}
	
	
	return false;
	
}


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
					if ( ( !document.form1.initial1[0].checked )
					&& ( !document.form1.initial1[1].checked ) )
					{
						alert ( "Select radio button for Accredited Investor Status" );
						return false;
					}
					if(!document.form1.nda_accept.checked){alert("Please read the Non-Disclosure Agreement message and confirm you agree to it");
return false; } 
							return true;
					
				}
			}
		}
	}
	return false;
}

function validateConfirm   (vfld,   // checkbox to be validated
                            ifld)   // id of element to receive info/error msg
{
  var stat = commonCheck2(vfld, ifld);
  if (stat != proceed) return stat;

  if (vfld.checked) return true;

  // if we get here then the validation has failed

  var errorMsg = 'Please read the above message and confirm you agree to it';

  msg (ifld, "error", errorMsg);
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
<script language="JavaScript">
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
</script>

<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
</head>

<body id="cus_application">

<div id="main">
	<div class="header">
    <table width="900" border="0" cellpadding="0">
  <tr>
    <td class="logo">
    
      <a href="http://www.corporatemerchantsolutions.com"><img src="images/header.png" width="890" height="102" border="0" class="png_img" /></a></td>
    </tr>
</table>
  </div>
    <div class="header2">
    	<h1>Corporate Merchant Services - Investors Profile</h1>
        
  </div>
<div class="container png_img">
   	<br />
      <table width="900" border="0" cellpadding="0">
     
       <tr>
      <td width="220" align="center">
      <div class="block1_top">
            <b>Investor Login</b>
          </div>
          <form action="main.php" method="post" onsubmit='return formValidatorLogin()' >
            <div class="block1_mid png_img">
              
                <p>Username<br/>
                	<input name="id_number" type="text" size="20"  id="id_number" tabindex="1"/> 
              </p>
                <p>Password<br/>
                <input name="password" type="password" size="20" id="password" tabindex="2"  /> 
                  
              </p>
                
                  <div align="center">
                  <input name="doLogin" type="submit" id="doLogin" value="Login" />
             </div>
             <div class="padd_up" align="center">
                
               <a href="admin.php">Admin Login</a>            </div>
          </div>
          </form>
          <div class="block1_but png_img">
          </div>
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
      <td width="705" align="justify" valign="top">Corporate Merchant Services is an electronic payment processing company that specializes in credit and debit card processing. The Company operates through two wholly owned subsidiaries: Corporate Merchant Solutions Inc. and Intel Merchant Services Inc. Corporate Merchant Solutions specializes in transaction processing  to high volume merchants.  Intel Merchant Services Inc. targets E-Comers Merchants and Internet Gateways. The Company is able to offer an industry unique total customer solution which includes; low cost transaction processing, merchant specific software, Merchant Cash Advance, Regional Sale Office (RSO) distribution and delivery systems.</td>
       </tr>
      </table>  
    

    <form action="main.php" name="form1" method="post"  onsubmit='return formValidator()'>
    <div class="application">
    
    <div id="sub3">
      <a class="fieldset_text_color" href="index.php">Register Here</a></div>

    

</div> <!--div application-->
</form>
     
</div> <!--div container-->
  
   
      
<?php include("Includefooter.html"); ?>
  

</div> <!--div main-->

</body>
</html>
