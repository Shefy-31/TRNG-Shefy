<?php
$id=$_GET['id'];
$con=mysqli_connect("localhost","root","ceymox123","DB1");
if(!$con){
    die("Connection failed".mysqli_connect_error());
}
$sql="delete from Data where id=$id";
echo $sql;
if(mysqli_query($con,$sql)){
echo "<script>alert('Data deleted');</script>";
}
header('Location:forms.php');


?>
