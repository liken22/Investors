<?php
session_start();
include 'config/config.php';
include 'config/functions.php';


if ($_POST['doLogin']=='Login')
{
$ID = $_POST['id_number']; //get info from form
$PASS = $_POST['password']; //get info from form
 
$_SESSION['id_number'] = $ID;// store session data
$_SESSION['password'] = $PASS; // store session data
$query = mysql_query("SELECT * FROM 1000_investor_admin WHERE admin_id = '$ID' AND password = '$PASS'");
echo mysql_error();
$nt=mysql_fetch_array($query);
$UID = $nt[UID];
$_SESSION['UID'] = $UID; // store session data
if (mysql_num_rows($query)== 0){
$msg = "Invalid Login. <br />Please Verify that your User or Password are correct.";
header("Location: admin.php?msg=$msg");
exit();
}else{
header('Location: admin_info.php');
}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>::..Corporate Merchant Solutions Investors Login..::</title>
<meta name="description" content="Corporate Merchant Solutions is offering free credit card terminal with rates as low as 1.03% and 10 cents a transaction.  Accept Credit Card Payments now with online Merchant Accounts." />
<meta name="keywords" content="Accept credit cards, Merchant account, Internet merchant account, Online merchant account, Merchant services, Accept credit cards online, Accept credit card payments, Accept credit card payments online, Accept credit cards now, Charge card machine" />
<meta name="distribution" content="global" />

<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	.png_img {behavior:url(iepngfix.htc);}

.style2 {
	color: #FFFFFF;
	font-size: 36px;
	font-weight: bold;
}

.style5 {
	color: #CC0000;
	font-size: 14px;
	text-align: center;
	font-weight: bold;
}
.style16 {
	font-size: 16px;
	font-weight: bold;
	color: #FFFFFF;
	text-align: center;
}
.style18 {
	font-size: 16px;
	font-weight: bold;
	color: #000000;
}
.style22 {color: #FF0000}
.style23 {
	font-size: 18px;
	font-weight: bold;
	color: #FF0000;
}
</style>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script type="text/javascript">
<!--

function formValidator(){
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
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body id="index">

<div id="main">
	<div class="header">
    <table width="900" border="0" cellpadding="0">
  <tr>
    <td class="logo">
      <a href="index.php"><img src="images/header.png" border="0" class="png_img" /></a></td>
    </tr>
</table>
  </div>
    <div class="header2">
    	<h1>Administrative Investors Login</h1>
        
  </div>
<div class="containerlogin png_img">
    	<p>&nbsp;</p>
      
    
        
    
    <div class="fleft png_img">
       	<div class=" back_top">
        	  <h3>Administrative Login</h3>
</p>
              <br/>
   	  </div>
          <div class="back_middle">
           <form action="admin.php" method="post" onsubmit='return formValidator()' >
              <div align="center">
              <table width="360" border="0" align="center" cellpadding="2" cellspacing="0">
                <tr>
                  <td width="140" height="25"><div align="left">User:</div></td>
                  <td width="232">
                    <input name="id_number" type="text" class="fieldset" id="id_number" tabindex="1"/></td>
                </tr>
                <tr>
                  <td height="25"><div align="left">Password:</div></td>
                  <td>
                  <input name="password" type="password" class="fieldset" id="password" tabindex="2"/></td>
                </tr>
                
              </table>
              </div>
                <br/>
              <table width="380" border="0" cellpadding="2">
                <tr>
                  <td width="372" align="center">
                    <input name="doLogin" type="submit" id="doLogin" value="Login" />
                  </td>
                </tr>
              </table>
              </form>
              
      </div>
      <div class="back_bot">
            
			  <p class="inner">&nbsp;</p><div class="style5">
  
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
        
                  <br/>  
      </div>
    </div>
   
      
  </div> <!--end container-->
  
<?php include("Includefooter.html"); ?>

</div>

</body>
</html>
