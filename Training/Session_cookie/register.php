<html>
    <head>
        <title>Register</title>
    </head>
    <style>
        h1{
            text-align : center ;
        }

        div{
            align-self : center;
            background-color : powderblue ;
            padding : 20px;           
            border-radius:5px;
            width: 500px;
            margin: auto;
        }

        table{
            font-size : 200%; 
            padding : 20px;   
        }

        input[type=email],input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        }

        input[type=submit] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        }

        input[type=submit]:hover {
        background-color: #45a049;
        }

    </style>
    <body>
        <h1>Register now</h1>
        <form method="POST" id=registerform>
            <div>
                <table>
                    <tr>
                        <td><label for="email">Email</label></td>
                        <td><input type="email" name="email" id="email">
                        <span id="emailError" style="color:red;"></span></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password</label></td>
                        <td><input type="password" name="password" id="password" placeholder="*****">
                        <span id="passwordError" style="color:red;"></span></td>
                    </tr>
                    <tr>
                        <td><a href="login.php"> Login now</a></td>
                        <td><input type="submit" name="submit" value="Register" id="register"></td>
                    </tr>
                </table>
            </div>
        </form>
    </body>
</html>
<?php
if(isset($_POST['submit'])){
    $_SESSION['email']=$_POST['email'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $con=mysqli_connect("localhost","root","ceymox123","DB1");
    if(!$con){
        die("Connection failed".mysqli_connect_error());
    }
    if( $email == "" || $password == ""){
        echo"<script>alert('Enter email id and password')</script>";
    }
    else{
        $sql1="select * from registration where email='$email' and password='$password'";
        $result=mysqli_query($con,$sql1) ;
        if(mysqli_fetch_array($result)){
            echo "Already exist";
        }else{
            $sql="INSERT INTO registration (email, password) VALUES ('$email', '$password')";  
            mysqli_query($con,$sql) ;
            header("Location:login.php");   
        }   
    }  
}
?>
<script>
$(document).ready(function() {
    $("#registerform").submit(function() {
        var email=$('#email').val();
        var password=$('#password').val();
        var regEx = /^[A-Z0-9][A-Z0-9._%+-]{0,63}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/;
        if (email == "") {
            $("#emailError").text("Enter your email");
            return false;
        }else if ( !regEx.test(email) ) {
            $('#emailError').after('<span class="error">Enter valid email</span>');  
            return false;
        }
        if (password == "") {
            $("#passwordError").text("Enter your password");
            return false;
        }

    });
});
</script>