<?php
// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');

$con = mysqli_connect('localhost', 'root', '','lot');
if($con) {
	echo 'connected successfully';
} else {
	echo 'connected failed';
}

// get the post records
$lotdate = $_POST['lotdate'];
$lottime = $_POST['lottime'];
$drawno = $_POST['drawno'];
$fstprice = $_POST['fstprice'];
$secprice = $_POST['secprice'];
$thiprice = $_POST['thiprice'];

// database insert SQL code
$sql = "INSERT INTO `lott` (`lotdate`, `lottime`, `drawno`, `fstprice`, `secprice`,`thiprice`) VALUES ('$lotdate', '$lottime', '$drawno', '$fstprice', '$secprice','$thiprice')";

// insert in database 
$rs = mysqli_query($con, $sql);

if($rs)
{
	header('Location: ./ViewerPanel/client.php');
} else {
	header('Location: ./index.php');
}

?>