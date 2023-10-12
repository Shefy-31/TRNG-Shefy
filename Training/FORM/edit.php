<!DOCTYPE html>
<html>
    <head>
        <title>Form</title>
        <style>
            
            h1{
                font-size:300%;
                text-align: center;
                font-family:verdana;
            }
            p{
                text-align:center;
                color:Green;
                font-size:200%;
            }
            div{
                text:white;
                background-color:#f2f2f2;
                padding: 20px;
                border-radius:5px;
                width: 1000px;
            }
            input[type=text],textarea{
                width: 500px;
                padding:10px;
                display: inline-block;
                box-sizing:border-box;
            }
            input[type=submit]{
                background-color:#45a049;
            }
        </style>
    </head>
    <body>
        <h1>Update data</h1>
<?php
$id=$_GET['id'];
$con=mysqli_connect("localhost","root","ceymox123","DB1");
if(!$con){
    die("Connection failed".mysqli_connect_error());
}
$sql="select * from Data where id=$id";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);

        echo "<center><div>
            <form method='POST'>
                <table>
                <tr>
                    <td><label for='fname'>First name</label></td>
                    <td><input type='text' name='fname' value='".$row['fname']."'></td>
                </tr>

                <tr>
                    <td><label for='lname'>Last Name</label></td>
                    <td><input type='text' name='lname' value=".$row['lname']." ></td>               
                </tr>

                <tr>
                    <td><label for='address'>Address</label></td>
                    <td><input type='text' name='address' value=".$row['address']." ></td>
                </tr>

                <tr>
                    <td><label for='phone'>Phone</label></td>
                    <td><input type='text' name='phone' value=".$row['phone']." ></td>
                </tr>

                <tr>
                    <td><label for='email'>Email</label></td>
                    <td><input type='email' name='email' value=".$row['email']." ></td>
                </tr>

                <tr>
                    <td> <input type='submit' name='submit' value='Update'></td>
                </tr>
                </table>
            </form>
        </div></center>";
if(isset($_POST['submit'])){
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $address=$_POST['address'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $sql1="update Data set fname='$fname',lname='$lname',address='$address',phone='$phone',email='$email' where id=$id";
        $result1=mysqli_query($con,$sql1);
        echo $sql1;
        if($result1){
        echo" <script>alert('Data updated')</script>";
        }
     header('Location:forms.php');
}      
?>
    </body>
</html>
