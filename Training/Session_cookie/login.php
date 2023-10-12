<?php
session_start();
?>
<html>
    <head>
        <title>Login</title>
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
        <h1>Login</h1>
        <form method="POST" >
            <div>
                <table>
                    <tr>
                        <td><label for="email">Email</label></td>
                        <td><input type="email" name="email" id="email" required></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password</label></td>
                        <td><input type="password" name="password" id="password" placeholder="*****" required></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="remember" id="remember">
                        <label for="remember">Remember</label></td>
                        <td><input type="submit" name="submit" value="Login"></td>
                    </tr>
                </table>
                <p><a href="register.php">New member! Register now</a></p>
            </div>
        </form>
    </body>
</html>
<?php
if(isset($_COOKIE['email']) and isset($_COOKIE['password'])){
    $email = $_COOKIE['email'];
    $password = $_COOKIE['password'];
    echo "<script>
    document.getElementById('email').value = '$email';
    document.getElementById('password').value = '$password';
    </script>";
}

if(isset($_POST['submit'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $con=mysqli_connect("localhost","root","ceymox123","DB1");
    if(!$con){
        die("Connection failed".mysqli_connect_error());
    }
    $sql="select * from registration where email='$email' and password='$password'";
    $result=mysqli_query($con,$sql);
    $row=mysqli_fetch_array($result);
    if ( $email == $row['email'] && $password == $row['password'] ) {
        if(isset($_POST['remember'])){
            setcookie('password',$password,time()+60*60*7);
            setcookie('email',$email,time()+60*60*7);
        }
        $_SESSION['email']=$row['email'];
        header('Location:welcome.php');
    }
    else {
        echo "<script>alert('Invalid user')</script>";
    }
    
}
?>
