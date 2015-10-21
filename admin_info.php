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
<title>::..Confirmation Form..::</title>
<meta name="description" content="Corporate Merchant Solutions is offering free credit card terminal with rates as low as 1.03% and 10 cents a transaction.  Accept Credit Card Payments now with online Merchant Accounts." />
<meta name="keywords" content="Accept credit cards, Merchant account, Internet merchant account, Online merchant account, Merchant services, Accept credit cards online, Accept credit card payments, Accept credit card payments online, Accept credit cards now, Charge card machine" />
<meta name="distribution" content="global" />

<script language="javascript" type="text/javascript" src="js/mootools-1.2-core.js"></script>
<script language="javascript" type="text/javascript" src="js/mootools-1.2-more.js"></script>

<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />

<script type="text/javascript">
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>

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
    <div class="fright link_marron"><a href="logout.php">Log out</a></div>
      <table width="900" border="0" cellpadding="0">
      <tr>
          <td height="32" colspan="2" align="left">
          <img src="images/space.png" width="5" height="4" class="img_floatleft" />
<div class="btn_120"><a class="btn_text_black" href="admin_passw.php" title="Change your password here">Change Password</a></div><img src="images/space.png" width="5" height="4" class="img_floatleft" />
<div class="btn_187"><a href="pictures.php" title="Corporate Headquarter" target="_blank" class="btn_text_black">Corporate Headquarter</a></div>
<br />
<br />
<hr /></td>
        </tr>
        <tr>
          <td height="32" colspan="2" align="left"><em><strong>Investors List</strong></em></td>
        </tr>
        </table>
        <table width="900" border="1" cellpadding="0">
        <tr>
        <td align="center" width="250">
        Investor Name        </td>
        <td align="center" width="250">
        Investor ID        </td>
        <td width="237" align="center">Broker</td>
        <td width="143" align="center">Phone</td>
        </tr>
        
        <?php 
		$query = mysql_query("SELECT * FROM 1000_investor_information");
		echo mysql_error();
		while ($ui =mysql_fetch_array($query)){?>
		<tr><td class="link_marron"><?php $inv_UID = encode_this($ui[UID]);?> <a href="inv_edit.php?inv_UID=<?php echo "$inv_UID" ?>"> <?php echo "$ui[inv_firstname] $ui[inv_lastname]" ?> </a></td>
		<td><?php echo "$ui[id_number]"?></td>
		<td><?php echo "$ui[id_broker]"?></td>
		<td><?php echo "$ui[inv_phone]"?></td></tr>
		<?php }?>
        
        </table>

   
   </div> <!--div application-->

     
  </div> <!--container-->
  
   
      
<!-- Footer----------------------->
  
<?php include("Includefooter.html"); ?> <!-- main-->

</div>
</body>
</html>