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
header("Location: index.php?msg=$msg");
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
echo "<meta http-equiv='refresh' content='0;URL=index.php'>"; 
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

function NewWindow() {
window.open("password_reset.php", "new", "width=220, height=220");
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
          <form action="index.php" method="post" onsubmit='return formValidatorLogin()' >
            <div class="block1_mid png_img">
              
                <p>Username (email)<br/>
                	<input name="id_number" type="text" size="20"  id="id_number" tabindex="1"/> 
              </p>
                <p>Password<br/>
                <input name="password" type="password" size="20" id="password" tabindex="2"  /> 
                  
              </p>
                
                  <div align="center">
                  <input name="doLogin" type="submit" id="doLogin" value="Login" />
             </div>
             <div class="padd_up text12" align="center">
                
              <a href="password_reset.php" target="_blank" onclick="NewWindow(); return false;">Password Reset</a> - <a href="admin.php">Admin Login</a>            </div>
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
    

    <form action="index.php" name="form1" method="post"  onsubmit='return formValidator()'>
    <div class="application">
    
    <div id="sub3">
    
    <table width="900" border="0" cellpadding="0">
    <tr>
    <td height="30" colspan="9" align="center" >
<label><b>Investor Profile</b></label><br /></td>
    </tr>
    
  	<tr>
    <td width="81" height="45" valign="middle" nowrap="nowrap">Prefix:</td>
    <td width="191" height="45" valign="middle" nowrap="nowrap"><select name="inv_prefix" id="inv_prefix" >
            <?php
            $sql = "SELECT prefix_id, prefix FROM static_prefix ".
            "ORDER BY prefix_id";
            
            $rs = mysql_query($sql);
            
            while($row = mysql_fetch_array($rs))
            {
              echo "<option value=\"".$row['prefix']."\">".$row['prefix']."\n  ";
            }
           ?>  
      </select>     </td>
    <td width="98" height="45" valign="middle" nowrap="nowrap">Last Name*:</td>
    <td width="197" height="45" valign="middle" nowrap="nowrap"><span id="sprytextfield1">
      <input name="inv_lastname" type="text" class="fieldset" id="inv_lastname" tabindex="2" maxlength="128" />
      <span class="textfieldRequiredMsg">Last Name is Required</span></span></td>
    <td height="45" colspan="2" valign="middle" nowrap="nowrap">First Name*:</td>
    <td height="45" colspan="3" valign="middle" nowrap="nowrap"><span id="sprytextfield2">
      <input name="inv_firstname" type="text" class="fieldset" id="inv_firstname" tabindex="3" maxlength="50" />
      <span class="textfieldRequiredMsg">First Name is Required</span></span></td>
  	</tr>
      <tr>
    <td height="45" valign="middle" nowrap="nowrap"> Address:</td>
    <td height="45" valign="middle" nowrap="nowrap">
      <input name="inv_address" type="text" class="fieldset" id="inv_address" tabindex="5" maxlength="50" />      </td>
      <td height="45" valign="middle" nowrap="nowrap">City:</td>
    <td height="45" valign="middle" nowrap="nowrap">
      <input name="inv_city" type="text" class="fieldset" id="inv_city" tabindex="6" maxlength="25" /></td>
   
    <td width="77" height="45" valign="middle" nowrap="nowrap">Zip Code:</td>
    <td width="52" height="45" valign="middle" nowrap="nowrap"><span id="sprytextfield5">
    <input name="inv_zip" type="text" class="fieldset" id="inv_zip" size="5" tabindex="7" maxlength="5" />
    <span class="textfieldInvalidFormatMsg">Only Numbers</span><span class="textfieldMaxCharsMsg">5 Digits Zip Code</span></span></td>
    <td width="102" height="45" valign="middle" nowrap="nowrap">State:</td>
    <td width="58" height="45" valign="middle" nowrap="nowrap">
      <select name="inv_state" id="inv_state" >
            <?php
            $sql = "SELECT state_id, state_abbr FROM static_state ".
            "ORDER BY state_abbr";
            
            $rs = mysql_query($sql);
            
            while($row = mysql_fetch_array($rs))
            {
              echo "<option value=\"".$row['state_id']."\">".$row['state_abbr']."\n  ";
            }
           ?>  
      </select>      </td>
      <td>
      </td>
      </tr>
  <tr>
    <td height="45" valign="middle" nowrap="nowrap">Company:</td>
    <td height="45" valign="middle" nowrap="nowrap">
    <input name="inv_company" type="text" class="fieldset" id="inv_company" tabindex="8" maxlength="128" />    </td>
    <td height="45" valign="middle" nowrap="nowrap"> Phone*:</td>
    <td height="45" valign="middle" nowrap="nowrap"><span id="sprytextfield8">
    <input name="inv_phone" type="text" class="fieldset" id="inv_phone" tabindex="9" maxlength="14" />
    <span class="textfieldRequiredMsg">Phone is required.</span></span></td>
    <td height="45" colspan="2" valign="middle" nowrap="nowrap">Email*:</td>
    <td height="45" colspan="3" valign="middle" nowrap="nowrap"><span id="sprytextfield9">
    <input name="inv_email" type="text" class="fieldset" id="inv_email" tabindex="10" maxlength="50" />
    <span class="textfieldRequiredMsg">Email is Required</span><span class="textfieldInvalidFormatMsg">Invalid Email Address</span></span></td>
    </tr>
  <tr>
    <td height="20" colspan="9" valign="top" class="text10"><em>(*) Requiered Field</em></td>
    </tr>
    <tr>
    <td height="45" colspan="9" valign="middle"><h6><em>Investor Qualification</em></h6></td>
    </tr>
   
  <tr>
    <td height="45" colspan="4" valign="middle"><b><h6>(A) Accredited Investor Status:</h6></b></td>
    <td height="45" colspan="2" valign="middle" nowrap="nowrap"></td>
    <td height="45" colspan="3" valign="middle" nowrap="nowrap"></td>
  </tr>
  <tr>
    <td height="45" colspan="9" valign="middle">
<h5>For Individual Investors Only</h5></td>
    </tr>
  <tr>
    <td height="45" valign="top" align="center">
      <input name="initial1" type="radio" tabindex="13" value="Individual"/><br />
(check)</td>
    <td height="45" colspan="8" valign="middle"><span class="fieldset_text_color"><strong>(1)</strong></span> I certify that I am an accredited investor because I have an individual net worth, or my spouse and I have a combined net worth, in excess of $1,000,000. For purposes of this questionnaire, "net worth" means the excess of total assets at fair market value including home,<sup>1</sup> home furnishings and automobiles, over total liabilities and/or I certify that I am an accredited investor because I had individual income (exclusive of any income attributable to my spouse) of more than $200,000 in each of the past two years, or joint income with my spouse of more than $300,000 in each of those years, and I reasonably expect to reach the same income level in the current year.<sup>2</sup></td>
    </tr>
  
  <tr>
    <td height="45" colspan="9" ><br />
<h5>For Corporations, Limited Liability Companies  or Partnerships</h5></td>
    </tr>
  <tr>
    <td height="45" valign="top" align="center">
      <input name="initial1" type="radio" tabindex="14" value="Corporation"/><br />
(check)</td>
    <td height="45" colspan="8" valign="middle"><span class="fieldset_text_color"><strong>(2)</strong></span> The Investor  hereby certifies that it is an accredited investor because it has total assets in excess of $5,000,000 and was not formed for the specific purpose of acquiring the securities offered and/or the Investor  hereby  certifies that it is an accredited  investor  because all of its equity owners are accredited investors. The Partnership, in its sole discretion, may request information regarding the basis on which such equity owners are accredited.</td>
  </tr>
  
  <tr>
    <td height="45" colspan="9" class="text12" ><br />
      <p><sup>1</sup> Notwithstanding anything to the contrary herein, for purposes of determining "net worth", the principal residence owned by an individual shall be valued either at (A) cost, including the cost of improvements, net of current encumbrances upon the property, or (B) the appraised value of the property as determined upon a written appraisal used by an institutional lender making a loan to the individual secured by the property, including the cost of subsequent improvements, net of current encumbrances upon the property.  "Institutional lender" means a bank, savings and loan company, industrial loan company, credit union or personal property broker or a company whose principal business is as a lender of loans secured by real property and which has such loans receivable in the amount of $2,000,000 or more.</p>
      <p>
<sup>2</sup> For purposes of this Subscription Agreement, individual income means adjusted gross income, as reported for Federal income tax purposes, less any income attributable to a spouse or to property owned by a spouse, increased by the following amounts (but not including any amounts attributable to a spouse or to property owned by a spouse): (i) the amount of any tax-exempt interest income under Section 103 of the Internal Revenue Code of 1986, as amended (the "Code"), received; (ii) the amount of losses claimed as a limited partner in a limited partnership as reported on Schedule E of Form 1040; (iii) any deduction claimed for depletion under Section 611 et seq. of the Code; (iv) amounts contributed to an Individual Retirement Account (as defined in the Code) or Keogh retirement plan; (v) alimony paid; and (vi) any elective contributions to a cash or deferred arrangement under Section 401(k) of the Code.</p></td>
    </tr>
  <tr>
    <td height="45" colspan="9" class="text12" align="center" ><textarea name="NDA" id="NDA" cols="10" rows="15" >Mutual Non-Disclosure Agreement
    
This non-disclosure agreement (“Agreement”) is between Corporate Merchant Services Inc. and the above Investor with the above address .


I. RECITALS

A. The above Investor wishes to receive certain trade secret, confidential and proprietary information (hereinafter collectively “Information”) pertaining to Corporate Merchant Services Inc. and its subsidiaries. This exchange includes all communication of Information between the parties in any form whatsoever, including oral, written and machine readable form including but not limited to a private placement memorandum, pertaining to the above.
 
B. The above Investor wishes to receive the Information for the sole purpose of reviewing CONFIDENTIAL INFORMATION OF CORPORATE MERCHANT SERVICES INC. regarding investing in the Company.
 
C. Corporate Merchant Services Inc. is willing to disclose the Information and the above Investor is willing to receive the Information (as “Receiving Party”) on the terms and conditions set forth herein. 

Therefore, Corporate Merchant Services Inc. and Investor agree, as follows: 

1. That the disclosure of Information by Corporate Merchant Services Inc and any of its subsidiaries including but not limited to: Corporate Merchant Solutions Inc., Intel Merchant Services Inc., and World Bankcard Solutions Inc. is in strictest confidence and thus Investor will: 

a. (1) Not disclose to any other person the Information and (2) use at least the same degree of care to maintain the Information secret as the Company uses in maintaining as secret its own secret information, but always at least a reasonable degree of care; 

b. Use the Information only for the above purpose; 

c. Restrict disclosure of the Information solely to those individuals or employees of Company having a need to know such Information in order to accomplish the purpose stated above;
 
d. Advise each such individual or employee, before he or she receives access to the Information, of the obligations of Company under this Agreement, and require each such employee to maintain those obligations; 

e. Within fifteen (15) days following request of Corporate Merchant Services Inc. , return to Corporate Merchant Services Inc. all documentation, copies, notes, diagrams, computer memory media and other materials containing any portion of the Information, or confirm to Corporate Merchant Services Inc., in writing, the destruction of such materials; and 

f. Immediately upon sale of Company or merger of Company with a third party, return to Corporate Merchant Services Inc. all documentation, copies, notes, diagrams, computer memory media and other materials containing any portion of the Information, or confirm to Corporate Merchant Services Inc., in writing, the destruction of such materials. 


2. This Agreement imposes no obligation on individual or Company with respect to any portion of the Information received from Corporate Merchant Services Inc. which (a)(1) was known to the Company prior to disclosure by Corporate Merchant Services Inc. and (2) as to which the individual or Company has no obligation not to disclose or use it, (b) is lawfully obtained by the individual or Company from a third party under no obligation of confidentiality is or becomes generally known or available other than by unauthorized disclosure, (d) is independently developed by the individual or Company or (e) is generally disclosed by Corporate Merchant Services Inc. to third parties without any obligation on the third parties. 

3. This Agreement imposes no obligation on individuals or Company with respect to any portion of the Information disclosed by Corporate Merchant Services Inc. , unless such portion is (a) disclosed in a written document or machine readable media marked “CONFIDENTIAL” at the time of disclosure or (b) disclosed in any other manner and summarized in a memorandum mailed to the individual or Company within thirty (30) days of the disclosure. Information disclosed by Corporate Merchant Services Inc. in a written document or machine readable media and marked “CONFIDENTIAL” includes, but is not limited to, the items, if any, set forth in PPM. The individual or Company hereby acknowledges receipt of the items listed in PPM or any exhibits, if any.
 
4. The Information shall remain the sole property of Corporate Merchant Services Inc. 

5. CORPORATE MERCHANT SERVICES INC. DOES NOT MAKE ANY REPRESENTATION WITH RESPECT TO AND DOES NOT WARRANT ANY INFORMATION PROVIDED UNDER THIS AGREEMENT, BUT SHALL FURNISH SUCH IN GOOD FAITH. WITHOUT RESTRICTING THE GENERALITY OF THE FOREGOING, CORPORATE MERCHANT SERVICES INC. DOES NOT MAKE ANY REPRESENTATIONS OR WARRANTIES, WHETHER WRITTEN OR ORAL, STATUTORY, EXPRESS OR IMPLIED WITH RESPECT TO THE INFORMATION WHICH MAY BE PROVIDED HEREUNDER, INCLUDING WITHOUT LIMITATION, ANY WARRANTY OF MERCHANTABILITY OR OF FITNESS FOR A PARTICULAR PURPOSE. CORPORATE MERCHANT SERVICES INC. SHALL NOT BE LIABLE FOR ANY SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGES OF ANY NATURE WHATSOEVER RESULTING FROM RECEIPT OR USE OF THE INFORMATION BY THE INDIVIDUAL OR COMPANY. 

6. In the event of a breach or threatened breach or intended breach of this Agreement by individual or Company, Corporate Merchant Services or its subsidiaries, in addition to any other rights and remedies available to it at law or in equity, shall be entitled to preliminary and final injunctions, enjoining and restraining such breach or threatened breach or intended breach. 

7. The validity, construction, and performance of this Agreement are governed by the laws of the state of Delaware. 

8. The rights and obligations of the parties under this Agreement may not be sold, assigned or otherwise transferred. 

9. If any arbitration, litigation or other legal proceeding relating to this Agreement occurs, the prevailing party shall be entitled to recover from the other party (in addition to any other relief awarded or granted) its reasonable costs and expenses, including attorney’s fees, incurred in the proceeding. 
This Agreement is binding upon Corporate Merchant Services Inc. and individual or Company, and upon the directors, officers, employees and agents of each. This Agreement is effective as of the later date of execution and will continue indefinitely, unless terminated on thirty (30) days written notice by either party. However, individual or Company’s obligations of confidentiality and restrictions on use of the Information disclosed by Corporate Merchant Services Inc. or its subsidiaries shall survive termination of this Agreement. 
</textarea>
    <?php $ip = $_SERVER['REMOTE_ADDR'] ?>
 <?php putenv("TZ=EST"); $date = date("Y-m-d H:i:s"); ?>
</td>
  </tr>
  <tr>
    <td height="45" colspan="5" class="indented_15"><input type="checkbox" name="nda_accept" id="nda_accept" value="Yes" />       By checking this box you agree the terms of this Non Disclosure Agreement and  the above information is true and correct. For security purposes your IP <?php echo "$ip" ?> is going to be used as your additional verification of your digital signature.</td>
    <td height="45" width="248" colspan="3" align="right" valign="top"  >
 <input type="hidden" name="inv_ip" id="inv_ip" value="<?php echo "$ip" ?>"/>
  <input type="hidden" name="inv_datetime" id="inv_datetime" value="<?php echo "$date" ?>"/>
     <input name="FormLogin" id="FormLogin" type="submit" class="png_img btn_248_red" value="Submit and Accept conditions"/></td>
    <td width="25" height="45" align="right"  >&nbsp;</td>
  </tr>
</table>
</div>

    

</div> <!--div application-->
</form>
     
</div> <!--div container-->
  
   
      
<?php include("Includefooter.html"); ?>
  

</div> <!--div main-->


<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-8779699-5");
pageTracker._trackPageview();
} catch(err) {}
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "zip_code", {isRequired:false, validateOn:["blur"]});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "none", {validateOn:["blur"]});
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "email", {validateOn:["blur"]});
</script>
</body>
</html>
