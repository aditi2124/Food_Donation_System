<?php
// Step 1: Connect to the database
$connection = mysqli_connect("localhost", "root", "", "waste_food");
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Step 2: Define the getCount function
function getCount($conn, $table) {
    $sql = "SELECT COUNT(*) AS total FROM $table";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    } else {
        return 0;
    }
}
$query = "SELECT * FROM food_donations";
$result = mysqli_query($connection, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="admin.css"/>
    <style>  :root {
    --primary-color: #06C167;
    --sidebar-bg: linear-gradient(135deg, #1e1e2f, #27293d);
    --card-gradient: linear-gradient(145deg, #06C167, #0b8b5e);
    --dark-bg: #1e1e2f;
    --light-bg: #ffffff;
    --text-light: #ffffff;
    --text-dark: #333333;
    --hover-bg: rgba(255, 255, 255, 0.1);
    --transition: all 0.5s ease;
}

/* Reset and base styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

body {
    display: flex;
    min-height: 100vh;
    background: linear-gradient(to right, #f5f7fa, #c3cfe2);
    transition: var(--transition);
}

body.dark {
    background: var(--dark-bg);
    color: var(--text-light);
}

/* Layout flex container */
.layout {
    display: flex;
    width: 100%;
    height: 100vh;
}

/* Sidebar: 30% width */
nav {
    width: 11%;
    background: var(--sidebar-bg);
    padding: 20px;
    color: var(--text-light);
    background-color: #1d1b31;
    transition: var(--transition);
    overflow-y: auto;
}

/* Dashboard: 70% width */
.dashboard {
    width: 70%;
    padding: 20px;
    background-color: var(--light-bg);
    color: var(--text-dark);
    transition: var(--transition);
    overflow-y: auto;
}

/* Dark mode compatibility */
body.dark .dashboard {
    background-color: #2c2c3d;
    color: #fff;
}


nav.close {
    width: 80px;
}

nav .logo-name {
    font-size: 22px;
    font-weight: bold;
    margin-bottom: 30px;
    text-align: center;
}

nav .menu-items {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
}

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

/* Dashboard Styles */


nav.close ~ .dashboard {
    margin-left: 80px;
    width: calc(100% - 80px);
}

.dashboard .top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.dashboard .logo {
    font-size: 24px;
    font-weight: 600;
}

.dash-content .title {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.boxes {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.box {
    flex: 1;
    min-width: 200px;
    background: var(--card-gradient);
    color: #fff;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    transition: var(--transition);
    cursor: pointer;
    animation: fadeInUp 0.5s ease;
}

.box:hover {
    transform: translateY(-5px);
}

.box .text {
    font-size: 16px;
    font-weight: 500;
    margin-top: 10px;
}

.box .number {
    font-size: 24px;
    font-weight: bold;
    margin-top: 5px;
}

/* Table Styles */
.table-container {
    overflow-x: auto;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    padding: 20px;
    margin-top: 20px;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table thead {
    background-color: #06C167;
    color: #fff;
}

.table th,
.table td {
    padding: 12px 15px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

.table tbody tr:hover {
    background-color: #f9f9f9;
}

button {
    background-color: #06C167;
    color: #fff;
    padding: 8px 12px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: var(--transition);
}

button:hover {
    background-color: #059457;
}

/* Dark Mode Overrides */
body.dark .dashboard,
body.dark .table-container {
    background-color: #2c2c3d;
    color: #fff;
}

body.dark .table thead {
    background-color: #0b8b5e;
}

body.dark .table tbody tr:hover {
    background-color: #3a3a50;
}

body.dark button {
    background-color: #0b8b5e;
}

body.dark button:hover {
    background-color: #06C167;
}

/* Mode Toggle Switch */
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

body.dark .switch {
    left: 22px;
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Fixes */
@media (max-width: 768px) {
    nav {
        position: absolute;
        z-index: 200;
    }

    .dashboard {
        margin-left: 80px;
        width: calc(100% - 80px);
    }

    nav.close ~ .dashboard {
        margin-left: 0;
        width: 100%;
    }

    .boxes {
        flex-direction: column;
    }
}


</style>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <title>Admin Dashboard Panel</title>
</head>

<body>
<div class="layout">
    <nav class="navbar">
        <div class="logo-name">
            <span class="logo_name">ADMIN</span>
        </div>
        <div class="menu-items">
            <ul class="nav-links">
                <i class='bx bx-menu sidebar-toggle'></i>
                <li><a href="#"><i class="uil uil-estate"></i><span class="link-name">Dashboard</span></a></li>
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

    <div class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <p class="logo">Food <b style="color: #06C167;">Donate</b></p>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>
                <div class="dash-content">

        <div class="boxes">
            <div class="box box1">
                <i class="uil uil-user"></i>
                <span class="text">Total Users</span>
                <span class="number"><?= getCount($connection, 'login') ?></span>
            </div>
            <div class="box box2">
                <i class="uil uil-comments"></i>
                <span class="text">Feedbacks</span>
                <span class="number"><?= getCount($connection, 'user_feedback') ?></span>
            </div>
            <div class="box box3">
                <i class="uil uil-heart"></i>
                <span class="text">Total Donates</span>
                <span class="number"><?= getCount($connection, 'food_donations') ?></span>
            </div>
        </div>
    </div>
</div>


         <div class="table-container">
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Food</th>
                    <th>Category</th>
                    <th>Phone</th>
                    <th>Date/Time</th>
                    <th>Address</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['food'] ?></td>
                    <td><?= $row['category'] ?></td>
                    <td><?= $row['phoneno'] ?></td>
                    <td><?= $row['date'] ?></td>
                    <td><?= $row['address'] ?></td>
                    <td><?= $row['quantity'] ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="order_id" value="<?= $row['Fid'] ?>" />
                            <button class="action-btn" type="submit" name="food">Get Food</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

            </div>
        </div>
    </div>
</div>
 </div>

    <script src="admin.js"></script>

<script>
    const body = document.querySelector('body'),
          sidebarToggle = document.querySelectorAll('.sidebar-toggle'),
          nav = document.querySelector('nav');

    sidebarToggle.forEach(btn => {
        btn.onclick = () => {
            nav.classList.toggle('close');
        }
    });
</script>

</body>
</html>
