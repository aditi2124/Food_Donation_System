
<?php
$connection = mysqli_connect("localhost", "root", "", "waste_food");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "<h3>Tables in 'waste_food':</h3>";
$result = mysqli_query($connection, "SHOW TABLES");
while ($row = mysqli_fetch_row($result)) {
    echo $row[0] . "<br>";
$query = "SELECT COUNT(*) as count FROM users";
$query = "SELECT COUNT(*) as count FROM `login`";

}
    $query="SELECT count(*) as count FROM login WHERE gender='male'";
    $result=mysqli_query($connection, $query);
    $row=mysqli_fetch_assoc($result);
    $male=$row['count'];

    $query="SELECT count(*) as count FROM login WHERE gender='female'";
    $result=mysqli_query($connection, $query);
    $row=mysqli_fetch_assoc($result);
    $female=$row['count'];

    $query="SELECT count(*) as count FROM food_donations WHERE location='Surat'";
    $result=mysqli_query($connection, $query);
    $row=mysqli_fetch_assoc($result);
    $Surat=$row['count'];

    $query="SELECT count(*) as count FROM food_donations WHERE location='Bardoli'";
    $result=mysqli_query($connection, $query);
    $row=mysqli_fetch_assoc($result);
    $Bardoli=$row['count'];

    $query="SELECT count(*) as count FROM food_donations WHERE location='Vyara'";
    $result=mysqli_query($connection, $query);
    $row=mysqli_fetch_assoc($result);
    $Vyara=$row['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard Panel</title> 

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    <!-- Icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
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


    /* =======================
       Dashboard Section
    ========================== */
    .dashboard {
    margin-left: 280px;
    padding: 20px 40px;
    width: 100%;
    background-color: #f6f8fa;
    min-height: 100vh;
}


    .top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .top p.logo {
        font-size: 28px;
        font-weight: bold;
        color: #333;
    }

    .overview .title {
        display: flex;
        align-items: center;
        font-size: 22px;
        margin-bottom: 20px;
    }

    .overview .title i {
        margin-right: 10px;
        color: var(--primary-color);
    }

    .boxes {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: nowrap; /* Ensures they stay in one row */
    margin-bottom: 30px;
}

.box {
    flex: 1;
    background: linear-gradient(135deg, #e3ffe7, #d9e7ff); /* gradient background */
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: transform 0.2s ease;
    margin: 0 10px;
    min-width: 200px;
}

.box i {
    font-size: 28px;
    color: #06C167;
}

.box .text {
    margin-top: 10px;
    font-size: 17px;
    font-weight: 600;
    color: #444;
}

.box .number {
    font-size: 30px;
    font-weight: bold;
    color: #000;
}


canvas {
    width: 100% !important;
    max-width: 1000px;
    height: 650px !important;
    margin-top: 40px;
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 0 25px rgba(6, 193, 103, 0.2);
    display: block;
    margin: 40px auto;
}



    /* Responsive Design */
    @media (max-width: 768px) {
        nav {
            display: none;
        }
        .dashboard {
            margin-left: 0;
            padding: 20px;
        }
    }
</style>


    <?php
     $connection = mysqli_connect("localhost:3306", "root", "");
     $db = mysqli_select_db($connection, 'waste_food');
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
            <p class="logo">Food <b style="color: #06C167;">Donate</b></p>
            <p class="user"></p>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-chart"></i>
                    <span class="text">Analytics</span>
                </div>

                <div class="boxes">
<!-- Total Users -->
<div class="box box1">
    <i class="uil uil-user"></i>
    <span class="text">Total Users</span>
    <span class="number">
        <?php
            $query = "SELECT COUNT(*) as count FROM login";
            $result = mysqli_query($connection, $query);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                echo $row['count'];
            } else {
                echo "Query error: " . mysqli_error($connection);
            }
        ?>
    </span>
</div>

    <!-- Feedbacks -->
    <div class="box box2">
        <i class="uil uil-comments"></i>
        <span class="text">Feedbacks</span>
        <span class="number">
            <?php
                $query = "SELECT COUNT(*) as count FROM user_feedback";
                $result = mysqli_query($connection, $query);
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    echo $row['count'];
                } else {
                    echo "Error";
                }
            ?>
        </span>
    </div>

    <!-- Donations -->
    <div class="box box3">
        <i class="uil uil-heart"></i>
        <span class="text">Total Donations</span>
        <span class="number">
            <?php
                $query = "SELECT COUNT(*) as count FROM food_donations";
                $result = mysqli_query($connection, $query);
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    echo $row['count'];
                } else {
                    echo "Error";
                }
            ?>
        </span>
    </div>
</div>

    </section>
 </body>
<script>
// User Gender Chart
var xValues = ["Male", "Female"];
var yValues = [<?php echo $male; ?>, <?php echo $female; ?>];
var barColors = ["#06C167", "blue"];

new Chart(document.getElementById("myChart"), {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: { display: false },
    title: {
      display: true,
      text: "User Gender Distribution"
    }
  }
});

// Donation Locations Chart
var locationLabels = ["Surat", "Bardoli", "Vyara"];
var locationData = [<?php echo $Surat; ?>, <?php echo $Bardoli; ?>, <?php echo $Vyara; ?>];
var locationColors = ["#06C167", "blue", "red"];

new Chart(document.getElementById("donateChart"), {
  type: "bar",
  data: {
    labels: locationLabels,
    datasets: [{
      backgroundColor: locationColors,
      data: locationData
    }]
  },
  options: {
    legend: { display: false },
    title: {
      display: true,
      text: "Food Donations by Location"
    }
  }
});

</script>            </div>
        </div>
    </section>
    <script src="admin.js"></script>
</body>
</html>