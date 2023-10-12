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
        <h1>Data collection</h1>
        <p>Fill the form</p>
        <center><div>
        <form method="POST" action ="forms.php" name="f1" onsubmit="return validateForm()">
                <table>
                <tr>
                    <td><label for="fname">First name</label></td>
                    <td><input type="text" name="fname" id="fname" >
                    <span id="fnameError" style="color:red;"></span></td>
                </tr>

                <tr>
                    <td><label for="lname">Last Name</label></td>
                    <td><input type="text" name="lname" id="lname" >
                    <span id="lnameError" style="color:red;"></span></td>

                <tr>
                    <td><label for="gender">Gender</label></td>
                    <td><label for="male">Male</label>
                        <input type="radio" name="gender" value="Male" id="">
                        <label for="female">Female</label>
                        <input type="radio" name="gender" value="Female" id=""></td>

                <tr>
                    <td><label for="address">Address</label></td>
                    <td><textarea name="address" id="" cols="30" rows="10" placeholder="Enter your address" ></textarea>
                    <span id="addressError" style="color:red;"></span></td>
                </tr>

                <tr>
                    <td><label for="phone">Phone</label></td>
                    <td><input type="text" name="phone" id="" >
                    <span id="phoneError" style="color:red;"></span></td>
                </tr>

                <tr>
                    <td><label for="email">Email</label></td>
                    <td><input type="email" name="email" id="" >
                    <span id="emailError" style="color:red;"></span></td>
                </tr>

                <tr>
                    <td> <input type="submit" name="submit" value="Submit"></td>
                </tr>
                </table>
            </form>

        </div></center>

    </body>
    </html>
    
<script>
function validateForm() {
    var fname = document.f1.fname.value;
    var fnameError = document.getElementById("fnameError");
    var lname = document.f1.lname.value;
    var lnameError = document.getElementById("lnameError");
    var address = document.f1.address.value;
    var addressError = document.getElementById("addressError");
    var phone = document.f1.phone.value;
    var phoneError = document.getElementById("phoneError");
    var email = document.f1.email.value;
    var emailError = document.getElementById("emailError");

    var Pattern=/^[A-Za-z]{3,}$/;
    var phonePattern=/^[7-9][0-9]{9}$/;
    var emailPattern=/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,})$/;
   if (fname == null || fname == "" ) {
        fnameError.innerHTML = "This is a required field";
        return false;
   } else if ( !Pattern.test(fname)) {
       fnameError.innerHTML = "Enter valid name";
        return false;
   } else {
    fnameError.innerHTML = "";
   }

   if ( lname == null || lname == "" ) {
        lnameError.innerHTML = "This is a required field";
        return false;
   } else if ( !Pattern.test(lname) ) {
        lnameError.innerHTML = "Enter valid name";
        return false;
   } else {
    lnameError.innerHTML = "";
   }

   if ( address == null || address == "" ) {
        addressError.innerHTML = "This is a required field";
        return false;
   } else if ( address.length >= 100 ){
        addressError.innerHTML = "Enter less than 100 characters";
        return false;
   } else {
    addressError.innerHTML = "";
   }

   if ( phone == null || phone == "" ) {
        phoneError.innerHTML = "This is a required field";
        return false;
   } else if ( !phonePattern.test(phone) ){
        phoneError.innerHTML = "Enter valid phone number";
        return false;
   } else {
    phoneError.innerHTML = "";
   }

   if ( email == null || email == "" ) {
        emailError.innerHTML = "This is a required field";
        return false;
   } else if( !emailPattern.test(email) ) {
        emailError.innerHTML = "Enter valid email";
        return false;
   } else {
    emailError.innerHTML = "";
   }
   return true;

}

</script>

<?php
$con=mysqli_connect("localhost","root","ceymox123","DB1");
if(!$con){
    die("Connection failed".mysqli_connect_error());
}
$sql2="select id,concat(fname,' ',lname)as name,gender,address,phone,email from Data";
$result2=mysqli_query($con,$sql2);
echo "<table border='1'>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Gender</th>
    <th>Address</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Edit</th>
    <th>Delete</th>
    </tr>";
while($row=mysqli_fetch_array($result2)){
    echo "<tr>
    <td>".$row['id']."</td>
    <td>".$row['name']."</td>
    <td>".$row['gender']." </td>
    <td>".$row['address']."</td>
    <td>".$row['phone']."</td>
    <td>".$row['email']."</td>
    <td><a href='edit.php?id=".$row['id']."'>Edit</td>
    <td><a href='delete.php?id=".$row['id']."'>Delete</td>
    </tr>";  
    }
    echo "</table>";

if(isset($_POST['submit'])){
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $gender=$_POST['gender'];
    $address=$_POST['address'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $sql1="select * from Data where email='$email'";
    $result1=mysqli_query($con,$sql1);
    $row=mysqli_fetch_array($result1);
    if ( $email == $row['email'] ) {
        echo "<script>alert('Email already exist') ;</script>";
    } else{
        $sql="insert into Data (fname,lname,gender,address,phone,email) values('$fname','$lname','$gender','$address','$phone','$email')";    
        if(mysqli_query($con,$sql)){
        echo "<script>alert('Data inserted successfully') ;</script>";
    }
}
}
?>
</html>