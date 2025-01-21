<?php
ob_start(); // Start output buffering

include('../includes/config.php');
include('../includes/checklogin.php');

$dbConnection = mysqli_connect($host, $dbuser, $dbpass, $db);

if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}

$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updateRow = $_POST["IDnumber"];
    $codeitem = $_POST["itemm"];
    $codeprice = $_POST["pricee"];
    $codedescription = $_POST["descriptionn"];
    $codestock = $_POST["stockk"];

    // Validate ID input
    if (!is_numeric($updateRow)) {
        $error_message = "Invalid ID. Please enter a number.";
    } else {
        // Use prepared statements to prevent SQL injection
        $stmt = mysqli_prepare($dbConnection, "UPDATE Store SET ITEM=?, PRICE_IN_PESO=?, DESCRIPTION=?, STOCK_QUANTITY=? WHERE ID=?");

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sdssd", $codeitem, $codeprice, $codedescription, $codestock, $updateRow);  // Correct number of params here

            if (mysqli_stmt_execute($stmt)) {
                if(mysqli_stmt_affected_rows($stmt) > 0) {
                    $success_message = "Item updated successfully!";
                } else {
                    $error_message = "No rows updated. Check if the ID exists.";
                }
            } else {
                $error_message = "Error updating item: " . mysqli_error($dbConnection);
            }

            mysqli_stmt_close($stmt);
        } else {
            $error_message = "Error preparing statement: " . mysqli_error($dbConnection);
        }

    }
}

mysqli_close($dbConnection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Change Item</title>

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
                <h1>Stock Inventory: UPDATE</h1>
                <form action="Change.php" method="post">
                    <label for="IDnumber">Input ID to Update Row</label>
                    <input type="text" name="IDnumber" id="IDnumber" required>

                    <label for="itemm">Input New Item</label>
                    <input type="text" name="itemm" id="itemm" required>

                    <label for="pricee">Input New Price in Peso</label>
                    <input type="text" name="pricee" id="pricee" required>

                    <label for="descriptionn">Input New Description</label>
                    <input type="text" name="descriptionn" id="descriptionn" required>

                    <label for="stockk">Input New Stock Quantity</label>
                    <input type="text" name="stockk" id="stockk" required>

                    <input type="submit" value="Confirm">
                    <?php if ($success_message): ?>
                        <div class="message success"><?php echo $success_message; ?></div>
                    <?php elseif ($error_message): ?>
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
<?php ob_end_flush(); ?>
