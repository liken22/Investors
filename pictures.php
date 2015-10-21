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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>::..Corporate Pictures..::</title>
<meta name="description" content="Corporate Merchant Solutions is offering free credit card terminal with rates as low as 1.03% and 10 cents a transaction.  Accept Credit Card Payments now with online Merchant Accounts." />
<meta name="keywords" content="Accept credit cards, Merchant account, Internet merchant account, Online merchant account, Merchant services, Accept credit cards online, Accept credit card payments, Accept credit card payments online, Accept credit cards now, Charge card machine" />
<meta name="distribution" content="global" />

<script language="javascript" type="text/javascript" src="js/mootools-1.2-core.js"></script>
<script language="javascript" type="text/javascript" src="js/mootools-1.2-more.js"></script>
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />

<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="js/lightbox.js"></script>

<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.png_img {behavior:url(iepngfix.htc);}
</style>

<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>

<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js" type="text/javascript"></script>

<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" /></head>

<body onload="initLightbox()" id="cus_application">



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
    <div class="fright link_marron"><a href="logout.php">Log out</a></div>
      <table width="900" border="0" cellpadding="0">
      <tr>
          <td height="32" colspan="2" align="left">
          <img src="images/space.png" width="5" height="4" class="img_floatleft" />
<div class="btn_120"><a class="btn_text_black" href="admin_passw.php" title="Change your password here">Change Password</a></div><img src="images/space.png" width="5" height="4" class="img_floatleft" />
<div class="btn_120"><a class="btn_text_black" href="admin_info.php" title="Main Page">Main Page</a></div><br />
<br />
<hr /></td>
        </tr>
        <tr>
          <td height="32" colspan="2" align="left"><em><strong>A look at the Corporate Headquarters</strong></em></td>
        </tr>
      </table>
        <table width="900" border="0" cellspacing="10" cellpadding="0">
        <tr>
            <td align="center" width="25%"><a href="images/image-1.jpg" rel="lightbox[conjunto]"><img src="images/image-1.jpg"  width="190" height="143"  border="0"/></a></td>
            <td align="center" width="25%"><a href="images/image-2.jpg" rel="lightbox[conjunto]"><img src="images/image-2.jpg"  width="190" height="143" border="0"/></a></td>
            <td width="25%" align="center"><a href="images/image-3.jpg" rel="lightbox[conjunto]"><img src="images/image-3.jpg"  width="190" height="143" border="0"/></a></td>
            <td width="25%"align="center"><a href="images/image-4.jpg" rel="lightbox[conjunto]"><img src="images/image-4.jpg"  width="190" height="143" border="0"/></a></td>
        </tr>
        <tr>
              <td align="center"><a href="images/image-5.jpg" rel="lightbox[conjunto]"><img src="images/image-5.jpg"  width="190" height="143" border="0"/></a></td>
              <td align="center"><a href="images/image-6.jpg" rel="lightbox[conjunto]"><img src="images/image-6.jpg"  width="190" height="143" border="0"/></a></td>
              <td align="center"><a href="images/image-7.jpg" rel="lightbox[conjunto]"><img src="images/image-7-cut.jpg"  width="190" height="143" border="0"/></a></td>
              <td align="center"><a href="images/image-8.jpg" rel="lightbox[conjunto]"><img src="images/image-8.jpg"  width="190" height="143" border="0"/></a></td>
        </tr>
        <tr>
          <td align="center"><a href="images/image-9.jpg" rel="lightbox[conjunto]"><img  src="images/image-9.jpg"  width="190" height="143" border="0"/></a></td>
          <td align="center"><a href="images/image-10.jpg" rel="lightbox[conjunto]"><img  src="images/image-10.jpg"  width="190" height="143" border="0"/></a></td>
          <td align="center"><a href="images/image-11.jpg" rel="lightbox[conjunto]"><img  src="images/image-11-cut.jpg"  width="190" height="143" border="0"/></a></td>
          <td align="center"><a href="images/image-12.jpg" rel="lightbox[conjunto]"><img  src="images/image-12.jpg"  width="190" height="143" border="0"/></a></td>
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