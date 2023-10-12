<?php
session_start();
$email=$_SESSION['email'];
?>
<html>
    <body>
        <h1>welcome <?php echo $email;?></h1>
       <div align="right">
        <a href="logout.php">logout</a>
        </div>

    </body>
</html>