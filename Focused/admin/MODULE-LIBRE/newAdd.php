<?php
// Database connection
include('../includes/config.php');
include('../includes/checklogin.php');

// Check database connection
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch data from the Store table
$showsql = "SELECT * FROM Store";
$transport = mysqli_query($mysqli, $showsql);

if (!$transport) {
    die("Error executing query: " . mysqli_error($mysqli));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-social.css">
    <link rel="stylesheet" href="../css/bootstrap-select.css">
    <link rel="stylesheet" href="../css/fileinput.min.css">
    <link rel="stylesheet" href="../css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Stock Inventory</title>

    <style>
        body {
            background: url('shop.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: sans-serif;
        }

        h1 {
            font-size: 45px;
            color: mintcream;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            width: 300px;
            background: rgba(0, 0, 0, 0.5);
            padding: 30px;
            border-radius: 8px;
            margin: 20px auto;
            box-sizing: border-box;
        }

        form label {
            display: block;
            color: white;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        form input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 2px solid red;
            font-size: 16px;
            text-transform: uppercase;
        }

        form input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: mintcream;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .message {
            text-align: center;
            margin-top: 10px;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>

    <?php include("../includes/header.php"); ?>

    <div class="ts-main-content">
        <nav class="ts-sidebar">
            <ul class="ts-sidebar-menu">
                <li class="ts-label">Main</li>
                <li><a href="../dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li>
                    <a href="#"><i class="fa fa-desktop"></i> Rooms</a>
                    <ul>
                        <li><a href="create-room.php">Add Room</a></li>
                        <li><a href="manage-rooms.php">Manage Rooms</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-desktop"></i> Food</a>
                    <ul>
                        <li><a href="../cfood.php">Add Food</a></li>
                        <li><a href="../manage-food.php">Manage Foods</a></li>
                    </ul>
                </li>
                <li><a href="../registration.php"><i class="fa fa-user"></i> Student Registration</a></li>
                <li><a href="../manage-students.php"><i class="fa fa-users"></i> Manage Students</a></li>
                <li><a href="Inventory.php"><i class="fa fa-desktop"></i> Inventory Management</a></li>
            </ul>
        </nav>

        <div class="content-wrapper">
            <div class="container-fluid">
                <br><br>
                <h1>Stock Inventory</h1>
                <form action="Add.php" method="post">
                    <label for="itemm">Item</label>
                    <input type="text" name="itemm" id="itemm" required>

                    <label for="pricee">Price in Peso</label>
                    <input type="text" name="pricee" id="pricee" required>

                    <label for="descriptionn">Description</label>
                    <input type="text" name="descriptionn" id="descriptionn" required>

                    <label for="stockk">Stock Quantity</label>
                    <input type="text" name="stockk" id="stockk" required>

                    <input type="submit" value="Confirm">
                    <?php if (isset($success_message)): ?>
                        <div class="message success"><?php echo $success_message; ?></div>
                    <?php elseif (isset($error_message)): ?>
                        <div class="message error"><?php echo $error_message; ?></div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/dataTables.bootstrap.min.js"></script>
</body>
</html>

<?php

// Close database connection
mysqli_close($mysqli);
?>
