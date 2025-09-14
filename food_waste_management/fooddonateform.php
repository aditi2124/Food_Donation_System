<?php
include("login.php"); 
if($_SESSION['name']==''){
	header("location: signin.php");
}
// include("login.php"); 
$emailid= $_SESSION['email'];
$connection=mysqli_connect("localhost","root","");
$db=mysqli_select_db($connection,'waste_food');
if(isset($_POST['submit']))
{
    $foodname=mysqli_real_escape_string($connection, $_POST['foodname']);
    $meal=mysqli_real_escape_string($connection, $_POST['meal']);
    $category=$_POST['image-choice'];
    $quantity=mysqli_real_escape_string($connection, $_POST['quantity']);
    // $email=$_POST['email'];
    $phoneno=mysqli_real_escape_string($connection, $_POST['phoneno']);
    $district=mysqli_real_escape_string($connection, $_POST['district']);
    $address=mysqli_real_escape_string($connection, $_POST['address']);
    $name=mysqli_real_escape_string($connection, $_POST['name']);
  

 



    $query="insert into food_donations(email,food,type,category,phoneno,location,address,name,quantity) values('$emailid','$foodname','$meal','$category','$phoneno','$district','$address','$name','$quantity')";
    $query_run= mysqli_query($connection, $query);
    if($query_run)
    {

        echo '<script type="text/javascript">alert("data saved")</script>';
        header("location:delivery.html");
    }
    else{
        echo '<script type="text/javascript">alert("data not saved")</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Food Donate</title>
  <style>
    body {
      background-color: #06C167;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
    }
    .contact-title {
      font-size: 1.2rem;
      font-weight: bold;
      margin-top: 20px;
      margin-bottom: 10px;
      text-align: center;
      color: #333;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
   .form-container {
  padding: 30px;
  background: white;
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  max-width: 700px;
  margin: auto;
}

    .regformf {
      background: #fff;
      padding: 40px 50px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      width: 80%;
      max-width: 900px;
    }

    .logo {
      text-align: center;
      font-size: 32px;
      font-weight: bold;
      margin-bottom: 30px;
      color: #333;
    }

    .input, .radio {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
      flex-wrap: wrap;
    }

    .input label, .radio label {
      min-width: 200px;
      font-weight: 600;
      margin-right: 10px;
      color: #333;
    }

    .input input[type="text"], 
    .input input[type="email"],
    .input input[type="number"],
    .input select {
      flex: 1;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }
.form-group {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

.form-group label {
  width: 150px;
  font-weight: 500;
}

.form-group input,
.form-group select {
  flex: 1;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

    .radio input[type="radio"] {
      margin-right: 10px;
    }

    .image-radio-group {
      display: flex;
      justify-content: space-around;
      flex: 1;
    }

    .image-radio-group input[type="radio"] {
      display: none;
    }

    .image-radio-group label {
      border: 2px solid transparent;
      border-radius: 10px;
      padding: 5px;
      transition: all 0.3s ease-in-out;
      cursor: pointer;
    }
    input[type="radio"] {
      width: 18px;
      height: 18px;
      margin-right: 5px;
    }

    .image-radio-group img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 8px;
    }

    .image-radio-group input[type="radio"]:checked + label {
      border: 2px solid #06C167;
      background-color: rgba(6, 193, 103, 0.1);
    }

    .btn {
      text-align: center;
      margin-top: 30px;
    }

    .btn button {
      background-color: #06C167;
      color: white;
      padding: 12px 30px;
      border: none;
      border-radius: 6px;
      font-size: 18px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn button:hover {
      background-color: #04a658;
    }

    p {
      text-align: center;
      font-size: 18px;
      font-weight: 600;
      color: #333;
    }

.food-category {
  display: flex;
  gap: 10px;
  justify-content: center;
  flex-wrap: wrap;
}

.food-category img {
  width: 120px;
  height: 120px;
  object-fit: cover;
  border-radius: 8px;
  cursor: pointer;
  border: 2px solid transparent;
  transition: border 0.3s ease;
}

   .food-category img.selected {
  border: 2px solid #00c851;
   }


  </style>
</head>
<body>
  <div class="container">
    <div class="regformf">
      <form action="" method="post">
        <p class="logo">Food <b style="color: #06C167;">Donate</b></p>

<div class="form-group">
  <label for="foodName">Food Name:</label>
<input type="text" id="foodName" name="foodname"> <!-- previously was name="foodName" -->

</div>


        <div class="radio">
          <label>Meal type:</label>
          <label>
          <input type="radio" name="meal" value="Veg"> Veg
          </label>
          <label>
          <input type="radio" name="meal" value="Non-Veg"> Non-Veg
          </label>

        </div>

        <div class="input">
          <label>Select the Category:</label>
          <div class="food-category">
            <input type="hidden" name="image-choice" id="image-choice">

  <img src="img/raw-food.png" alt="Raw Food" onclick="selectCategory(this)">
  <img src="img/cooked-food.png" alt="Cooked Food" onclick="selectCategory(this)">
  <img src="img/packed-food.png" alt="Packed Food" onclick="selectCategory(this)">
</div>

        </div>

        <div class="input">
          <label for="quantity">Quantity (No. of persons / kg):</label>
          <input type="text" id="quantity" name="quantity" required />
        </div>

       <div class="contact-title">Contact Details</div>

        <div class="input">
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" value="<?php echo $_SESSION['name']; ?>" required />
        </div>

        <div class="input">
          <label for="phoneno">Phone No:</label>
          <input type="text" id="phoneno" name="phoneno" maxlength="10" pattern="[0-9]{10}" required />
        </div>

        <div class="input">
          <label for="district">City:</label>
          <select id="district" name="district">
            <option value="Surat">Surat</option>
            <option value="Bardoli">Bardoli</option>
            <option value="Vyara">Vyara</option>
            <option value="Vapi">Vapi</option>
            <option value="Valsad">Valsad</option>
            <option value="Navasari">Navasari</option>
            <option value="Vadodara">Vadodara</option>
            <option value="Rajkot">Rajkot</option>
          </select>

          <label for="address" style="margin-left: 20px;">Address:</label>
          <input type="text" id="address" name="address" required />
        </div>

        <div class="btn">
          <button type="submit" name="submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
  <script> 
function selectCategory(element) {
  document.querySelectorAll('.food-category img').forEach(img => img.classList.remove('selected'));
  element.classList.add('selected');

  // Set hidden input value
  document.getElementById('image-choice').value = element.alt; // "Raw Food", "Cooked Food", etc.
}

</script>
</body>
</html>
