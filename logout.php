<?php
include('admin/connection.inc.php');
include('admin/functions.inc.php');

unset($_SESSION['USER_LOGIN']);
unset($_SESSION['USER_ID']);
unset($_SESSION['USER_NAME']);
unset($_SESSION['USER_EMAIL']);

header('location: index.php');
die();
?>