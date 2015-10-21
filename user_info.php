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


$query = mysql_query("SELECT * FROM 1000_investor_information WHERE UID = '$UID'");
echo mysql_error();
$nt=mysql_fetch_array($query);
$UID = $nt[UID];
$password = $nt[password];
$email = $nt[inv_email];
$phone = $nt[inv_phone];
$firstname = $nt[inv_firstname];
$lastname = $nt[inv_lastname];
$inv_prefix = $nt[inv_prefix];

//button User Proceeds 
if ($_POST['btn_proceeds']=='Use of Proceeds')
{

$mailto = "ir@cmsimail.com";
$mail = "ir@cmsimail.com";

$message = "Investor Use of Proceeds Requiered.

Investor First and Last Name: $inv_prefix $firstname $lastname

Investor Email: $email

Investor Phone: $phone

";

$headers.= "From: $mail\r\n" ;
$headers.= "Bcc: raulfernandez@cmsimail.com\r\n";
$headers.= "Content-Type: text/plain;";

$r = mail("$mailto", "$firstname $lastname Investor Use of Proceeds Requiered", "$message", $headers);
header("Location: ../documents/CMS_USE_OF_PROCEEDS.pdf");
exit();
}

//button Private Placement Memorandum
if ($_POST['btn_private']=='Private Placement Memorandum')
{

$mailto = "ir@cmsimail.com";
$mail = "ir@cmsimail.com";

$message = "Investor Private Placement Memorandum Requiered.

Investor First and Last Name: $inv_prefix $firstname $lastname

Investor Email: $email

Investor Phone: $phone

";

$headers.= "From: $mail\r\n" ;
$headers.= "Bcc: raulfernandez@cmsimail.com\r\n";
$headers.= "Content-Type: text/plain;";

$r = mail("$mailto", "$firstname $lastname Investor Private Placement Memorandum Requiered", "$message", $headers);

header("Location: ../documents/ppm.pdf");
exit();
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

<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
</head>

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
    

<div class="fleft"><b>Welcome <? echo "$nt[inv_firstname]"?>&nbsp;<? echo "$nt[inv_lastname]"?></b></div>
<div class="fright link_marron"><a href="logout.php">Log out</a></div><br />
    
      <table width="900" border="0" cellpadding="0">
      <tr>
          <td height="32" align="left">
<img src="images/space.png" width="5" height="4" class="img_floatleft" />
<form method="post" action="user_info.php"><input onmouseover="this.style.color='white';" onmouseout="this.style.color='black';"  type="submit" name="btn_private" id="btn_private" class="btn_248 btn_strong" value="Private Placement Memorandum"/></form>
<img src="images/space.png" width="5" height="4" class="img_floatleft" />
<form method="post" action="user_info.php"><input type="submit" onmouseover="this.style.color='white';"onmouseout="this.style.color='black';"    name="btn_proceeds" id="btn_proceeds" class="btn_161 btn_strong" value="Use of Proceeds"/></form>
<img src="images/space.png" width="5" height="4" class="img_floatleft" />
<div class="btn_161 btn_padtop3"><a class="btn_text_black" href="pictures_user.php">Corporate Headquarter</a></div>
 <img src="images/space.png" width="5" height="4" class="img_floatleft" />
 <div class="btn_161 btn_padtop3"><a href="http://www.cmsinvestor.com/documents/CASH_ADVANCE_PROGRAM.pdf" target="_blank" class="btn_text_black">Cash Advance Program</a></div>
<img src="images/space.png" width="5" height="4" class="img_floatleft" />
<div class="btn_120"><a class="btn_text_black" href="user_passw.php">Change Password</a></div>

<br /><br />
<hr /></td>
        </tr>
      
        <tr>
          <td height="32" align="center"><h2><em><strong><font style="color:#003366">Executive Summary</font></strong></em></h2></td>
        </tr>
        <tr>
          <td height="32" align="justify" class="link_marron">Corporate Merchant Services is an electronic payment processing company that specializes in credit and debit card processing. The Company operates through two wholly owned subsidiaries: Corporate Merchant Solutions Inc. and Intel Merchant Services Inc. Corporate Merchant Solutions specializes in high transaction processing by providing POS (Point of Sale = electronic cash registers &amp; Scanners) to high volume merchants like: Grocery Stores, Supermarkets, and Fast Food Restaurants etc. Intel Merchant Services Inc. targets E-Comers Merchants, Internet Gateways and Small Mom &amp; Pop retail business. The Company is able to offer an industry unique total customer solution which includes; low cost transaction processing, merchant specific software, Merchant Cash Advance, Regional Sale Office (RSO) distribution and delivery systems, Certified Merchant Consultant training for industry trained representatives. Offering this total solution to internet and retail merchants will allow Corporate Merchant Services  to capture daily recurring revenue previously unavailable.<br />
            <br />
            Below are key points explaining where we are as a company and why we are in the best possible position to be the most significant player in the electronic payment arena.  We have positioned our company and products to meet the needs and demands that face the retail and e-comers merchants. We have seen tremendous interest in our Apple iPhone application and RIMM Blackberry application for processing of credit and offline debit cards with a potential to process an additional 18,000,000 new merchants in the United States. There has been movement within our industry that creates even greater demand for our products &amp; services and is a confirmation that our total solution offering is very relevant and fills the voids facing merchants today.<br />
            <br />
            The Company is well positioned and is relevant as it enters into its growth stage. The Company is seeking $5,000,000 as growth capital that is needed to become profitable within  12-18 months. The proceeds of this capital will be allocated for continued working capital &amp; operations, increase independent sales representatives &amp; marketing exposures and to begin the merchant cash advance program. Our plan for the CMS-POS equipment (CMS-integrated electronic cash register) segment is designed to offer systems for sale and/or lease our POS equipment through our in house financing program (Merchant Cash Advance) or third party leasing. This provides a financial model that takes the large equipment outlay, ownership expense and transfers it to monthly manageable costs that are influenced by transactions processed by the merchant. Our plans on the CMS-POS segment is to partner with large supermarket and fast food franchisors and distribute our equipment and processing services to their franchisees.<br />
            <br />
            <div align="center"><u>INDUSTRY DEVELOPMENTS</u></div><br />
            <br />
            In 2009, there were more than 51 billion credit &amp; debit card based transactions.  The industry as a whole processed well in excess of $2.9 trillion dollars last year.  Debit card transactions accounted for 61.52% of the total, up from 57.51% in 2008 and there are no signs that this trend is slowing. The industry earned an average of $.19 per debit transaction which is in line with the company’s earnings on debit swipes.<br />
            <br />
            <div align="center"><u>STRATEGIC PARTNERS</u></div><br />
            <br />
            Corporate Merchant Solutions Inc. has agreements with First Data the largest credit and debit card platform processor in the world in addition to being a Registered ISO/MSP of J.P. Morgan Chase Bank and Wells Fargo Bank for VISA &amp; MasterCard Registration. Intel Merchant Services Inc. is in current negations with HSBC and Global Payments for VISA &amp; MasterCard Registration sponsorship and backend platform processing. IMS has partnered with IPayment for front end processing. The Company also has agreements with Global e Telecom Inc. for its check processing and is currently in discussions with numerous companies for additional services.<br />
            <br />
             <div align="center"><u>KEY DEVELOPMENTS</u></div><br />
            <br />
            • Corporate Merchant Solutions Inc. unveiled this year the CMS-POS-ECR (a simplified electronic cash register software integration system) an affordable electronic cash register scanner system for supermarkets, grocery stores and retail outlets that will scan products and process sales faster through cashier lanes which will save more time and money to the merchant. The Company has been installing these POS systems and has been receiving rave reviews.<br />
            <br />
            • CMS has also recently launched its New Website that has been under development for 6 months: <a href="http://www.corporatemerchantsolutions.com" target="_blank">www.corporatemerchantsolutions.com</a> The Company also has launched numerous websites to attract different market segments. IMS has also recently launched its New Website: <a href="http://www.mdqdigital.com/ims" target="_blank">www.intelmerchantservices.com</a> and is working on a replicatable website for its sales force.
            <br />
            <br />
            • Intel Merchant Services Inc. has been marketing applications for cell phones that will turn a cell phone into a credit card point of sale machine. These applications can be used on the Apple iPhone, RIMM Blackberry and hundreds of new cell phones. The potential market could be as many 18,000,000 new merchants. We are on top of new industry trends, changes, and we have partnered up with new technology companies that will continue to provide us with an operational edge for years to come. <br />
            <br />
            • Corporate Merchant Services Inc. is in the process of integrating all facilities under one roof in Central Florida which will bring huge cost savings and increased productivity. This will allow both Corporate Merchant Solutions Inc. and Intel Merchant Services Inc. to share staff and resources in addition to making the Company overall more efficient.<br />
            <br />
            • The Company and its subsidiaries are launching an aggressive nationwide Independent  Representative recruiting campaign with Carrier Builders and USA Today over the next 12 months that is expected to add hundreds or possibly thousand of new Representatives. These Representatives will go through a complete company training that will certify our representatives on our processing platform.<br />
            <br />
            • Market conditions are perfect for our products and services due to changes in the economy and a high unemployment. In 2007 though 2009 tens of thousands of companies went out of business and or scaled back laying of millions of people. This has caused an opportunity to go after new businesses that are forming due to lack of employment opportunities. These conditions will also help the Company in its recruiting efforts.<br />
            <br />
             
      </table>
      
   
   </div> <!--div application-->

     
  </div> <!--container-->
  
   
      
<!-- Footer----------------------->
  
<?php include("Includefooter.html"); ?>
<!-- main-->

</div>
</body>
</html>