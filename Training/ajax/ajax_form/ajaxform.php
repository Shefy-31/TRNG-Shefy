<!DOCTYPE html>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
            #ajax-data{
            text-align: left;
            font-size: 20px;
            }

        </style>
    </head>
    <body>
        <h1>Ajax form</h1>
        <center><div>
        <form method="POST" id="formData" onsubmit="return validateForm()">
                <table>
                <tr>
                    <td><label for="fname">Full name</label></td>
                    <td><input type="text" name="fname" id="fname" >
                    <span id="fnameError" style="color:red;"></span></td>
                </tr>

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
                    <td> <input type="button" id="submit" value="Submit"></td>
                </tr>
                </table>
            </form>
        <div id="ajax-data">

        </div>
     </div></center>
       
    </body>
    </html>
    <script type="text/javascript"></script>
    <script>
        $('#submit').on('click',function(){
            $.ajax({
                type : 'post',
                url : "ajaxsubmit.php",
                data : $('#formData').serialize(),
                success : function(response){
                    $("#ajax-data").html(response);
                },
                error:function(){
                    alert("error");
                }
            });
        });
        function validateForm() {
        var fname = document.f1.fname.value;
        var fnameError = document.getElementById("fnameError");
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