<?php
session_start();
// $connection = mysqli_connect("localhost:3307", "root", "");
// $db = mysqli_select_db($connection, 'demo');
include '../connection.php';
$msg=0;
if (isset($_POST['sign'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $sanitized_emailid =  mysqli_real_escape_string($connection, $email);
  $sanitized_password =  mysqli_real_escape_string($connection, $password);
  // $hash=password_hash($password,PASSWORD_DEFAULT);

  $sql = "select * from admin where email='$sanitized_emailid'";
  $result = mysqli_query($connection, $sql);
  $num = mysqli_num_rows($result);
 
  if ($num == 1) {
    while ($row = mysqli_fetch_assoc($result)) {
      if (password_verify($sanitized_password, $row['password'])) {
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $row['name'];
        $_SESSION['location'] = $row['location'];
        $_SESSION['Aid']=$row['Aid'];
        header("location:admin.php");
      } else {
        $msg = 1;
        // echo '<style type="text/css">
        // {
        //     .password input{
                
        //         border:.5px solid red;
                
                
        //       }

        // }
        // </style>';
        // echo "<h1><center> Login Failed incorrect password</center></h1>";
      }
    }
  } else {
    echo "<h1><center>Account does not exists </center></h1>";
  }




  // $query="select * from login where email='$email'and password='$password'";
  // $qname="select name from login where email='$email'and password='$password'";


  // if(mysqli_num_rows($query_run)==1)
  // {
  // //   $_SESSION['name']=$name;

  //   // echo "<h1><center> Login Sucessful  </center></h1>". $name['gender'] ;

  //   $_SESSION['email']=$email;
  //   $_SESSION['name']=$name['name'];
  //   $_SESSION['gender']=$name['gender'];
  //   header("location:home.html");

  // }
  // else{
  //   echo "<h1><center> Login Failed</center></h1>";
  // }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="formstyle.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
  <style>
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

.error {
  font-size: 14px;
  color: red;
  margin-top: 5px;
}
</style>
  <title>Login</title>
</head>
<body>
  <div class="container">
    <form id="form" method="post">
      <span class="title">Login</span>

      <div class="input-group">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" required>
        <div class="error"></div>
      </div>

      <div class="input-group password">
        <label class="textlabel" for="password">Password</label>
        <input type="password" name="password" id="password" required />
        <i class="uil uil-eye-slash showHidePw" id="showpassword"></i>
        <!-- Optional PHP Error Message -->
        <?php
        if (isset($msg) && $msg == 1) {
          echo '<p class="error">Password doesn\'t match.</p>';
        }
        ?>
      </div>

      <button type="submit" name="sign">Login</button>

      <div class="login-signup">
        <span class="text">Don't have an account?
          <a href="signup.php" class="text login-link">Register</a>
        </span>
      </div>
    </form>
  </div>

    <script src="login.js" ></script>
    <!-- <script src="../login.js"></script> -->
</body>
</html>