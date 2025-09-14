<?php
session_start();
include 'connection.php';
// $connection = mysqli_connect("localhost:3307", "root", "");
// $db = mysqli_select_db($connection, 'demo');
$msg=0;
if (isset($_POST['sign'])) {
  $email =mysqli_real_escape_string($connection, $_POST['email']);
  $password =mysqli_real_escape_string($connection, $_POST['password']);
 
  // $sanitized_emailid =  mysqli_real_escape_string($connection, $email);
  // $sanitized_password =  mysqli_real_escape_string($connection, $password);

  $sql = "select * from login where email='$email'";
  $result = mysqli_query($connection, $sql);
  $num = mysqli_num_rows($result);
 
  if ($num == 1) {
    while ($row = mysqli_fetch_assoc($result)) {
      if (password_verify($password, $row['password'])) {
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $row['name'];
        $_SESSION['gender'] = $row['gender'];
        header("location:home.html");
      } else {
        $msg = 1;
   
      }
    }
  } else {
    echo "<h1><center>Account does not exists </center></h1>";
  }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="loginstyle.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: url('img/p1.jpeg') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(15px);
      padding: 40px 35px;
      border-radius: 20px;
      width: 90%;
      max-width: 400px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
      color: #fff;
      text-align: center;
      animation: fadeIn 1s ease-in-out;
    }

    .logo {
      font-size: 32px;
      margin-bottom: 10px;
    }

    .logo b {
      color: #06C167;
    }

    #heading {
      font-size: 18px;
      margin-bottom: 25px;
    }

    .input, .password {
      position: relative;
      margin-bottom: 25px;
    }

    input {
      width: 100%;
      padding: 12px 40px 12px 15px;
      border: none;
      border-radius: 30px;
      background: rgba(255, 255, 255, 0.2);
      color: white;
      outline: none;
      font-size: 14px;
    }

    input::placeholder {
      color: rgba(255, 255, 255, 0.7);
    }

    .input i, .password i {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: white;
      cursor: pointer;
    }

    .error {
      color: #ff4d4d;
      font-size: 13px;
      margin-top: 5px;
    }

    .btn button {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 30px;
      background-color: #06C167;
      color: white;
      font-weight: 600;
      cursor: pointer;
      font-size: 16px;
      transition: all 0.3s ease;
    }

    .btn button:hover {
      background-color: #049e55;
      transform: scale(1.03);
    }

    #signin-up {
      margin-top: 15px;
      font-size: 14px;
    }

    #signin-up a {
      color: #06C167;
      text-decoration: none;
      font-weight: bold;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }

    @media (max-width: 500px) {
      .container {
        padding: 30px 25px;
      }

      .logo {
        font-size: 28px;
      }

      #heading {
        font-size: 16px;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <form action="" method="post">
      <p class="logo">Food <b>Donate</b></p>
      <p id="heading">Welcome back!</p>

      <div class="input">
        <input type="email" placeholder="Email address" name="email" required />
        <i class="fas fa-envelope"></i>
      </div>

      <div class="password">
        <input type="password" placeholder="Password" name="password" id="password" required />
        <i class="fas fa-eye-slash" id="togglePassword"></i>
        <?php if ($msg == 1): ?>
          <p class="error">Password does not match.</p>
        <?php endif; ?>
      </div>

      <div class="btn">
        <button type="submit" name="sign">Sign In</button>
      </div>

      <div class="signin-up">
        <p id="signin-up">Don't have an account? <a href="signup.php">Register</a></p>
      </div>
    </form>
  </div>

  <script>
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      this.classList.toggle('fa-eye');
      this.classList.toggle('fa-eye-slash');
    });
  </script>
</body>
</html>
    <script src="login.js"></script>
    <script src="admin/login.js"></script>
</body>

</html>
