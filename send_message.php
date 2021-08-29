<?php
include('admin/connection.inc.php');
include('admin/functions.inc.php');

$name = get_safe_value($con, $_POST['name']);
$email = get_safe_value($con, $_POST['email']);
$mobile = get_safe_value($con, $_POST['mobile']);
$subject = get_safe_value($con, $_POST['subject']);
$message = get_safe_value($con, $_POST['message']);
$added_on = date('Y-m-d h:i:s');

$contact_query = "INSERT INTO contact_us(name,email,mobile,subject,message,added_on) VALUES('$name','$email','$mobile','$subject','$message','$added_on')";
mysqli_query($con, $contact_query);

echo "Thanks for connecting with us, will get back to you shortly";

?>