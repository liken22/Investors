<?php 

//date format to update database
function format_date($string){
$owner_date = trim($string);
$owner_date = explode("/", trim($owner_date));
list($month, $day, $year) = $owner_date;
$unix_timestamp = mktime(0,0,0,$month,$day,$year);
$string = date('Y/m/d', $unix_timestamp);
return $string;
}

//date format to show properly date on field
function format_database_date($string){
$owner_date = trim($string);
$owner_date = explode("-", trim($owner_date));
list($year, $month, $day) = $owner_date;
$unix_timestamp = mktime(0,0,0,$month,$day,$year);
$string = date('m/d/Y', $unix_timestamp);
return $string;
}

function str_asegurar($cadena){
//elimino etiquetas HTML y PHP
$cadena = strip_tags($cadena);
//elimino el caracter comilla
$cadena = str_replace("'","",$cadena);
//elimino el caracter porcentaje
$cadena = str_replace("%","",$cadena);
//reemplaza la coma por el punto
$cadena = str_replace(",",".",$cadena);
return $cadena;
} 

function get_rep_code($rep_code){
//extract first latter of last name
$letter = strtolower($rep_code[0]);
//look for that letter on the database
$aquery = mysql_query("SELECT * FROM static_alphabet WHERE letter= '$letter'");
$adata = mysql_fetch_array ($aquery);

//set the variable with the month on the table of the selected letter
$month = $adata['month'];
//if month didn't change just add 1 to counter of the selected letter
if (date(m)==$month){
	mysql_query("UPDATE static_alphabet SET counter = counter+1 WHERE letter='$letter'");
}

elseif(date(m)<$month){
	//if month is less that actual month table we are on January so we set the motn to 1	
	mysql_query("UPDATE static_alphabet SET month = 1 WHERE month=12");
	//reset the counter to 0
	mysql_query("UPDATE static_alphabet SET counter = 0 WHERE counter<>0");
	mysql_query("UPDATE static_alphabet SET counter = 1 WHERE letter='$letter'");
	
}else{
//if actual month is more than the table month increment month value +1
	mysql_query("UPDATE static_alphabet SET month = month+1 WHERE month='$month'");
	//reset the counter to 0
	mysql_query("UPDATE static_alphabet SET counter = 0 WHERE counter<>0");
	mysql_query("UPDATE static_alphabet SET counter = 1 WHERE letter='$letter'");
}
$get_number = mysql_query("SELECT * FROM static_alphabet WHERE letter= '$letter'");
$new_num = mysql_fetch_array ($get_number);
$number = $new_num['counter'];
$rep_code = strtoupper($letter) . date(m) . date(y) . $number;
return $rep_code;
}

//return a value from prefix drop down list
function select_prefix($value){
$sql = "SELECT prefix_id, prefix FROM static_prefix ".
		"ORDER BY prefix_id";
		
		$rs = mysql_query($sql);
		
		while($row = mysql_fetch_array($rs))
		{
		  echo "<option value=$row[prefix]";
		  
		  if ($row[prefix] == $value) {
		 echo " SELECTED";
		 }
		 echo ">$row[prefix]</option>";
		  
	  	 }
}

//return a value from state drop down list
function select_state($value){
$sql = "SELECT state_id, state_abbr FROM static_state ".
		"ORDER BY state_abbr";
		
		$rs = mysql_query($sql);
		
		while($row = mysql_fetch_array($rs))
		{
		  echo "<option value=$row[state_id]";
		  
		  if ($row[state_id] == $value) {
		 echo " SELECTED";
		 }
		 echo ">$row[state_abbr]</option>";
		  
	  	 }
}

//return a value from carrier drop down list
function select_carrier($value){
$sql = "SELECT carrier_id, carrier FROM static_carriers ".
		"ORDER BY carrier_id";
		
		$rs = mysql_query($sql);
		
		while($row = mysql_fetch_array($rs))
		{
		  echo "<option value=$row[carrier_id]";
		  
		  if ($row[carrier_id] == $value) {
		 echo " SELECTED";
		 }
		 echo ">$row[carrier]</option>";
		  
	  	 }
}

//redirect to another page
function redirect_to($location = NULL){
	if ($location != NULL) {
	header("Location: {$location}");
	exit;
	}
}

//retrive individual name or corporation name
function get_name($type, $last, $first){
if ($type == 'individual'){
echo "$last" . ' ' . "$first";
}elseif ($type == 'corporation'){
echo "$nt[CORPORATE_NAME]";
}
}

//encode variable to send via URL
function encode_this($string) {
    $control = "extra";
    $tmp_string = $string;
    $string = $control.$tmp_string.$control;
 
    $string = base64_encode($string);
 
    return($string);
}

//decode variable sended via URL
function decode_this($string) {
    $string = base64_decode($string);
    $control = "extra";
    $string = str_replace($control, "", "$string");
 
    return $string;
}

//get carrier
function get_carrier($code){
$sql = "SELECT carrier FROM static_carriers where carrier_id = $code ";
$rs = mysql_query($sql);
$row = mysql_fetch_array($rs);
$string=$row[carrier];
return $string;
}

//get state
function get_state($code){
$sql = "SELECT state_abbr FROM static_state where state_id = $code ";
$rs = mysql_query($sql);
$row = mysql_fetch_array($rs);
$string = $row[state_abbr];
return $string;
}


// send email once application has been ompleted
function sendemail_investors($email, $pass){

$sql = mysql_query("SELECT * FROM 1000_investor_information WHERE inv_email = '$email' AND password = '$pass'");
echo mysql_error();
$get_info = mysql_fetch_array ($sql);
$id_number = $get_info[id_number];
$firstname = $get_info[inv_firstname];
$lastname = $get_info[inv_lastname];
$email = $get_info[inv_email];
$password = $get_info[password];
$inv_prefix = $get_info[inv_prefix];

$mailto = "$email" ;
$mail = "ir@cmsimail.com";

$message = "$inv_prefix $firstname $lastname,

Thank you for inquiring and filling out our form.

This link will take you to the login page of our investor website. Use your email $email as your login ID and your temporary password is $password.

http://www.CMSinvestor.com

This is an automated response. Please do not directly reply to this email.

";

$headers.= "From: $mail\r\n" ;
$headers.= "Bcc: raulfernandez@cmsimail.com\r\n";
$headers.= "Content-Type: text/plain;";

$r = mail("$mailto", "Welcome to Corporate Merchant Solutions", "$message", $headers);
}

// send email once application has been ompleted
function sendemail_investors_CMS($email, $pass){

$sql = mysql_query("SELECT * FROM 1000_investor_information WHERE inv_email = '$email' AND password = '$pass'");
echo mysql_error();
$get_info = mysql_fetch_array ($sql);
$id_number = $get_info[id_number];
$firstname = $get_info[inv_firstname];
$lastname = $get_info[inv_lastname];
$email = $get_info[inv_email];
$password = $get_info[password];
$inv_prefix = $get_info[inv_prefix];
$inv_ip = $get_info[inv_ip];
$inv_datetime = $get_info[inv_datetime];
$type = $get_info[initial1];

$mailto = "ir@cmsimail.com" ;
$mail = "ir@cmsimail.com";

$message = "New Investor Information.

Investor First and Last Name: $inv_prefix $firstname $lastname

Investor Email: $email

Investor temporary password: $password

Investor IP: $inv_ip

Investor Date and Time application: $inv_datetime

Investor Type: $type

";

$headers.= "From: $mail\r\n" ;
$headers.= "Bcc: raulfernandez@cmsimail.com, caseygerena@cmsimail.com, johnvazquez@cmsimail.com\r\n";
$headers.= "Content-Type: text/plain;";

$r = mail("$mailto", "New Investor Information.", "$message", $headers);
}

// send email once application has been ompleted
function sendemail($rep_number, $rep){
if( $rep == 'individual'){
$sql = mysql_query("SELECT * FROM 1000_ind_info WHERE ind_number = '$rep_number'");
echo mysql_error();
$get_info = mysql_fetch_array ($sql);
$id_number = $get_info[ind_number];
$firstname = $get_info[ind_firstname];
$lastname = $get_info[ind_lastname];
$email = $get_info[ind_email];

$mailto = "$email" ;
$mail = "hr@cmsimail.com";

$message = "Dear $firstname $lastname

Thank you for filling out our form.

This is an automated response. Please do not directly reply to this email.

Please access this link to see your information by placing your new personal code $id_number and your Social Security Number. 

http://www.corporatemerchantsolutions.com/vo/emailaccess.php

To access your website go to http://www.corporatemerchantsolutions.com/$id_number
";

$headers.= "From: $mail\r\n" ;
$headers.= "Content-Type: text/plain;";

$r = mail("$mailto", "Welcome to Corporate Merchant Solutions", "$message", $headers);


}elseif ( $rep == 'corporation'){
$sql = mysql_query("SELECT * FROM 1000_rep_info WHERE REP_NUMBER = '$rep_number'");
echo mysql_error();
$get_info = mysql_fetch_array ($sql);
$id_number = $get_info[REP_NUMBER];
$firstname = $get_info[OWNER1_FIRSTNAME];
$lastname = $get_info[OWNER1_LASTNAME];
$email = $get_info[CORPORATE_EMAIL];

$mailto = "$email" ;
$mail = "hr@cmsimail.com";

$message = "Dear $firstname $lastname

Thank you for filling out our form.

This is an automated response. Please do not directly reply to this email.

Please access this link to see your information by placing your new personal code $id_number and your Social Security Number. 

http://www.corporatemerchantsolutions.com/vo/emailaccessc.php
";

$headers.= "From: $mail\r\n" ;
$headers.= "Content-Type: text/plain;";

$r = mail("$mailto", "Welcome to Corporate Merchant Solutions", "$message", $headers);

}

}

?>