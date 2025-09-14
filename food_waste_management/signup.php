<?php
include 'connection.php';
// $connection=mysqli_connect("localhost:3307","root","");
// $db=mysqli_select_db($connection,'demo');
if(isset($_POST['sign']))
{

    $username=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $gender=$_POST['gender'];

    $pass=password_hash($password,PASSWORD_DEFAULT);
    $sql="select * from login where email='$email'" ;
    $result= mysqli_query($connection, $sql);
    $num=mysqli_num_rows($result);
    if($num==1){

        echo "<h1><center>Account already exists</center></h1>";
    }
    else{
    
    $query="insert into login(name,email,password,gender) values('$username','$email','$pass','$gender')";
    $query_run= mysqli_query($connection, $query);
    if($query_run)
    {
      
       
        header("location:signin.php");
       
    }
    else{
        echo '<script type="text/javascript">alert("data not saved")</script>';
        
    }
}


   
}
?>




<!-- Keep your PHP backend logic at the top as-is -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register | Food Donate</title>
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"/>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      min-height: 100vh;
      background: linear-gradient(135deg, #06C167, #20B486, #3EB489);
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 1rem;
      transition: all 0.3s ease-in-out;
    }

    .container {
      width: 100%;
      max-width: 420px;
      padding: 2rem;
      border-radius: 20px;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(20px);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
      color: #fff;
    }

    .logo {
      text-align: center;
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 1rem;
    }

    .logo b {
      color: #fff;
      background: #06C167;
      padding: 0.1rem 0.5rem;
      border-radius: 8px;
    }

    .container h2 {
      text-align: center;
      font-size: 1.4rem;
      margin-bottom: 1.5rem;
    }

    form label {
      font-weight: 500;
      margin-bottom: 0.2rem;
      display: block;
      font-size: 0.9rem;
    }

    form input[type="text"],
    form input[type="email"],
    form input[type="password"] {
      width: 100%;
      padding: 0.75rem;
      margin-bottom: 1rem;
      border: none;
      border-radius: 12px;
      font-size: 1rem;
      background-color: rgba(255, 255, 255, 0.2);
      color: #fff;
    }

    form input::placeholder {
      color: #eee;
    }

    .password-container {
      position: relative;
    }

    .password-container i {
      position: absolute;
      right: 1rem;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #ddd;
    }

    .gender {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
      gap: 1rem;
    }

    .gender div {
      display: flex;
      align-items: center;
    }

    .gender input[type="radio"] {
      width: 20px;
      height: 20px;
      margin-right: 8px;
      accent-color: #06C167;
      cursor: pointer;
    }

    .gender label {
      font-weight: normal;
      font-size: 1rem;
      cursor: pointer;
    }

    .btn {
      width: 100%;
      padding: 0.75rem;
      border: none;
      border-radius: 12px;
      background-color: #06C167;
      color: #fff;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn:hover {
      background-color: #049652;
      transform: scale(1.03);
    }

    .signin-link {
      text-align: center;
      margin-top: 1rem;
      font-size: 0.9rem;
    }

    .signin-link a {
      color: #fff;
      text-decoration: underline;
    }

    @media (max-width: 500px) {
      .container {
        padding: 1.5rem;
      }
    }
  </style>
</head>
<body>

<div class="container">
  <p class="logo">Food <b>Donate</b></p>
  <h2>Create your account</h2>

  <form action="" method="post">
    <label for="name">User Name</label>
    <input type="text" id="name" name="name" placeholder="Enter your name" required />

    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Enter your email" required />

    <label for="password">Password</label>
    <div class="password-container">
      <input type="password" id="password" name="password" placeholder="Create a password" required />
      <i class="uil uil-eye-slash" id="togglePassword"></i>
    </div>

    <div class="gender">
      <div>
        <input type="radio" id="male" name="gender" value="male" required />
        <label for="male">Male</label>
      </div>
      <div>
        <input type="radio" id="female" name="gender" value="female" />
        <label for="female">Female</label>
      </div>
    </div>

    <button class="btn" type="submit" name="sign">Continue</button>

    <div class="signin-link">
      Already have an account? <a href="signin.php">Sign in</a>
    </div>
  </form>
</div>
<!-- <script src="login.js"></script> -->
    <script src="admin/login.js"></script>

<script>
  const togglePassword = document.getElementById('togglePassword');
  const passwordInput = document.getElementById('password');

  togglePassword.addEventListener('click', function () {
    const type = passwordInput.type === 'password' ? 'text' : 'password';
    passwordInput.type = type;
    this.classList.toggle('uil-eye');
    this.classList.toggle('uil-eye-slash');
  });
</script>
       
</body>
</html>