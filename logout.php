<?php
session_start();
session_destroy();
$msg = "You have been Logged Out";
header("Location: index.php?msg=$msg");
?>
