
<?php
//$connection = mysqli_connect("localhost:3307", "root", "");
//$db = mysqli_select_db($connection, 'waste_food');
include "../connection.php";
include("connect.php"); 
$connection = mysqli_connect("localhost", "root", "", "waste_food");

if($_SESSION['name']==''){
	header("location:signin.php");
}
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="admin.css">
  <style>
  :root {
    --primary-color: #06C167;
    --sidebar-bg: linear-gradient(135deg, #1e1e2f, #27293d);
    --hover-bg: rgba(255, 255, 255, 0.1);
    --text-light: #ffffff;
    --transition: all 0.5s ease;
}

/* Sidebar Styles */
nav {
    position: fixed;
    width: 250px;
    background: var(--sidebar-bg);
    padding: 20px;
    transition: var(--transition);
    color: var(--text-light);
    z-index: 100;
    height: 100vh;
    background-color: #1d1b31;
    left: 0;
    top: 0;
}

nav.close {
    width: 80px;
}

nav .logo-name {
    font-size: 22px;
    font-weight: bold;
    margin-bottom: 30px;
    text-align: center;
    color: #fff;
}

nav .menu-items {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
}

/* Menu Links */
.nav-links li,
.logout-mode li {
    list-style: none;
    margin: 15px 0;
}

.nav-links a,
.logout-mode a {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    color: #fff;
    padding: 10px 15px;
    border-radius: 8px;
    transition: var(--transition);
}

.nav-links a:hover,
.logout-mode a:hover {
    background-color: var(--hover-bg);
}

/* Toggle Icon */
.sidebar-toggle {
    font-size: 26px;
    color: #fff;
    cursor: pointer;
    transition: var(--transition);
    margin-bottom: 20px;
}

nav.close .link-name {
    display: none;
}

/* Dark Mode Toggle */
.mode-toggle {
    display: inline-block;
    width: 40px;
    height: 20px;
    background: #555;
    border-radius: 10px;
    position: relative;
    cursor: pointer;
}

.switch {
    position: absolute;
    top: 2px;
    left: 2px;
    background: #fff;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    transition: var(--transition);
}

/* Adjust switch position in dark mode */
body.dark .switch {
    left: 22px;
}


</style>
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin Dashboard Panel</title> 
    
<?php
 $connection=mysqli_connect("localhost:3306","root","");
 $db=mysqli_select_db($connection,'waste_food');
 


?>
</head>
<body>
 <nav>
        <div class="logo-name">
            <span class="logo_name">ADMIN</span>
        </div>
        <div class="menu-items">
            <ul class="nav-links">
<i class='bx bx-menu sidebar-toggle'></i>

                <li><a href="admin.php"><i class="uil uil-estate"></i><span class="link-name">Dashboard</span></a></li>
                <li><a href="analytics.php"><i class="uil uil-chart"></i><span class="link-name">Analytics</span></a></li>
                <li><a href="donate.php"><i class="uil uil-heart"></i><span class="link-name">Donates</span></a></li>
                <li><a href="feedback.php"><i class="uil uil-comments"></i><span class="link-name">Feedbacks</span></a></li>
                <li><a href="adminprofile.php"><i class="uil uil-user"></i><span class="link-name">Profile</span></a></li>
            </ul>
            <ul class="logout-mode">
                <li><a href="../logout.php"><i class="uil uil-signout"></i><span class="link-name">Logout</span></a></li>
                <li class="mode">
                    <a href="#"><i class="uil uil-moon"></i><span class="link-name">Dark Mode</span></a>
                    <div class="mode-toggle"><span class="switch"></span></div>
                </li>
            </ul>
        </div>
    </nav>
    <section class="dashboard">
        
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <!-- <p>Food Donate</p> -->
            <p  class ="logo" >Food <b style="color: #06C167; ">Donate</b></p>
             <p class="user"></p>
            <!-- <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div> -->
            
            <!--<img src="images/profile.jpg" alt="">-->
        </div>
        <br>
        <br>
        <br>
    
  

            <div class="activity">
               
            <div class="location">
                <!-- <p class="logo">Filter by Location</p> -->
          <form method="post">
             <label for="location" class="logo">Select Location:</label>
             <!-- <br> -->
            <select id="location" name="location">
               <option value="Surat">Surat</option>
               <option value="Bardoli">Bardoli</option>
               <option value="Vyara">Vyara</option>
               <option value="Navasari">Navasari</option>
               <option value="Vadodara">Vadodara</option>
               <option value="Baruch">Baruch</option>
               <option value="Vapi">Vapi</option>
               <option value="Valsad">Valsad</option>
               <option value="Rajkot">Rajkot</option>

            </select>
                <input type="submit" value="Get Details">
         </form>
         <br>

         <?php
    // Get the selected location from the form
    if(isset($_POST['location'])) {
      $location = $_POST['location'];
      
      // Query the database for people in the selected location
      $sql = "SELECT * FROM food_donations WHERE location='$location'";
      $result=mysqli_query($connection, $sql);
    //   $result = $conn->query($sql);
      
      // If there are results, display them in a table
      if ($result->num_rows > 0) {
        // echo "<h2>Food Donate in $location:</h2>";
        
        echo" <div class=\"table-container\">";
        echo "    <div class=\"table-wrapper\">";
        echo "  <table class=\"table\">";
        echo "<table><thead>";
        echo" <tr>
        <th >Name</th>
        <th>food</th>
        <th>Category</th>
        <th>phoneno</th>
        <th>date/time</th>
        <th>address</th>
        <th>Quantity</th>
        
    </tr>
    </thead><tbody>";

        while($row = $result->fetch_assoc()) {
            echo "<tr><td data-label=\"name\">".$row['name']."</td><td data-label=\"food\">".$row['food']."</td><td data-label=\"category\">".$row['category']."</td><td data-label=\"phoneno\">".$row['phoneno']."</td><td data-label=\"date\">".$row['date']."</td><td data-label=\"Address\">".$row['address']."</td><td data-label=\"quantity\">".$row['quantity']."</td></tr>";

        //   echo "<tr><td>" . $row["name"] . "</td><td>" . $row["phoneno"] . "</td><td>" . $row["location"] . "</td></tr>";
        }
        echo "</tbody></table></div>";
      } else {
        echo "<p>No results found.</p>";
      }
      
   
    }
  ?>
 </div>

 

            
            </div>
    </section>

    <script src="admin.js"></script>
</body>
</html>
