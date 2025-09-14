<?php
// session_start();
// $connection=mysqli_connect("localhost:3307","root","");
// $db=mysqli_select_db($connection,'demo');
include '../connection.php';
$msg=0;
if(isset($_POST['sign']))
{

    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    $location=$_POST['district'];
    $address=$_POST['address'];

    $pass=password_hash($password,PASSWORD_DEFAULT);
    $sql="select * from admin where email='$email'" ;
    $result= mysqli_query($connection, $sql);
    $num=mysqli_num_rows($result);
    if($num==1){
        // echo "<h1> already account is created </h1>";
        // echo '<script type="text/javascript">alert("already Account is created")</script>';
        echo "<h1><center>Account already exists</center></h1>";
    }
    else{
    
    $query="insert into admin(name,email,password,location,address) values('$username','$email','$pass','$location','$address')";
    $query_run= mysqli_query($connection, $query);
    if($query_run)
    {
        // $_SESSION['email']=$email;
        // $_SESSION['name']=$row['name'];
        // $_SESSION['gender']=$row['gender'];
       
        header("location:signin.php");
        // echo "<h1><center>Account does not exists </center></h1>";
        //  echo '<script type="text/javascript">alert("Account created successfully")</script>'; -->
    }
    else{
        echo '<script type="text/javascript">alert("data not saved")</script>';
        
    }
}


   
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formstyle.css">
    <script src="signin.js" defer></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <style>
        /* formstyle.css */

/* formstyle.css */

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}

body {
  background: linear-gradient(135deg, #74ebd5, #9face6);
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
}

.container {
  background-color: #ffffff;
  padding: 50px 40px;
  border-radius: 15px;
  box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
  width: 500px;
  max-width: 95%;
}

form {
  display: flex;
  flex-direction: column;
}

.title {
  font-size: 32px;
  font-weight: bold;
  text-align: center;
  margin-bottom: 30px;
  color: #333;
}

.input-group,
.input-field,
.password {
  margin-bottom: 20px;
  position: relative;
}

.input-group label,
.textlabel {
  display: block;
  margin-bottom: 10px;
  color: #222;
  font-size: 16px;
  font-weight: 600;
}

input[type="text"],
input[type="email"],
input[type="password"],
textarea,
select {
  width: 100%;
  padding: 14px 12px;
  border-radius: 8px;
  font-size: 16px;
  border: 1px solid #ccc;
  transition: all 0.3s ease-in-out;
}

textarea {
  resize: vertical;
  height: 90px;
}

input:focus,
textarea:focus,
select:focus {
  border-color: #06C167;
  outline: none;
  box-shadow: 0 0 0 2px rgba(6, 193, 103, 0.2);
}

button {
  background: linear-gradient(to right, #06C167, #40e495);
  border: none;
  padding: 14px;
  border-radius: 8px;
  font-size: 18px;
  font-weight: 600;
  color: white;
  cursor: pointer;
  transition: background 0.3s ease-in-out;
}

button:hover {
  background: linear-gradient(to right, #40e495, #06C167);
}

.login-signup {
  text-align: center;
  margin-top: 20px;
}

.login-signup .text {
  font-size: 15px;
  color: #555;
}

.login-signup a {
  color: #06C167;
  text-decoration: none;
  font-weight: bold;
}

.uil-eye-slash {
  position: absolute;
  right: 12px;
  top: 42px;
  cursor: pointer;
  color: #666;
  font-size: 18px;
}

</style>
    <title>Register</title>
</head>
<body>
<div class="container">
    <form action="" method="post" id="form">
        <span class="title">Register</span>

        <div class="input-group">
            <label for="username">Name</label>
            <input type="text" id="username" name="username" required />
        </div>

        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required />
        </div>

        <label class="textlabel" for="password">Password</label>
        <div class="password">
            <input type="password" name="password" id="password" required />
            <i class="uil uil-eye-slash showHidePw" id="showpassword"></i>
            <?php if ($msg == 1) {
                echo ' <i class="bx bx-error-circle error-icon"></i>';
                echo '<p class="error">Password don\'t match.</p>';
            } ?>
        </div>

        <div class="input-group">
            <label for="address">Address</label>
            <textarea id="address" name="address" required></textarea>
        </div>

        <div class="input-field">
            <select id="district" name="district" required>
                <option value="ahmedabad" selected>Ahmedabad</option>
                <option value="surat">Surat</option>
                <option value="vadodara">Vadodara</option>
                <option value="rajkot">Rajkot</option>
                <option value="bhavnagar">Bhavnagar</option>
                <option value="jamnagar">Jamnagar</option>
                <option value="junagadh">Junagadh</option>
                <option value="gandhinagar">Gandhinagar</option>
                <option value="anand">Anand</option>
                <option value="navsari">Navsari</option>
                <option value="bharuch">Bharuch</option>
                <option value="mehsana">Mehsana</option>
                <option value="nadiad">Nadiad</option>
                <option value="porbandar">Porbandar</option>
                <option value="valsad">Valsad</option>
                <option value="patan">Patan</option>
                <option value="morbi">Morbi</option>
                <option value="botad">Botad</option>
            </select>
        </div>

        <button type="submit" name="sign">Register</button>

        <div class="login-signup">
            <span class="text">Already a member?
                <a href="signin.php" class="text login-link">Login Now</a>
            </span>
        </div>
    </form>
</div>
    <script src="login.js" ></script>
    <!-- <script src="../login.js"></script> -->
</body>
</html>