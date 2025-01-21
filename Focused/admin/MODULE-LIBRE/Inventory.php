<?php
// Database connection
include('../includes/config.php');
include('../includes/checklogin.php');

$dbConnection = $mysqli;

// Check connection
if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch data from the Store table
$showsql = "SELECT * FROM Store";
$transport = mysqli_query($dbConnection, $showsql);
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
            background: url('../shop.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        h1 {
            font-size: 45px;
            color: mintcream;
            text-transform: uppercase;
            display: inline-block;
        }

        button {
            font-size: 20px;
            padding: 5px 5px;
            background: mintcream;
            border: solid;
            border-color: black;
            color: black;
        }

        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background: linear-gradient(skyblue, lightgreen);
        }

        tr:nth-child(even) {
            background: linear-gradient(yellow, mintcream);
        }

        tr:nth-child(odd) {
            background: white;
        }

        .page-title {
            font-size: 36px;
            color: #333;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <?php include("../includes/header.php");?>

    <div class="ts-main-content">
    <nav class="ts-sidebar"> <!--- ADMIN SIDEBAR---->
			<ul class="ts-sidebar-menu">
			
				<li class="ts-label">Main</li>
				<li><a href="../dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>

					<li><a href="#"><i class="fa fa-desktop"></i> Rooms</a>
					<ul>
						<li><a href="create-room.php">Add Room</a></li>
						<li><a href="manage-rooms.php">Manage Rooms</a></li>
					</ul>
				</li>

				<li><a href="#"><i class="fa fa-desktop"></i>Food </a>
					<ul>
						<li><a href="../cfood.php">Add Food</a></li>
						<li><a href="../manage-food.php">Manage Foods</a></li>
						
					</ul>
				</li>


				<li><a href="../registration.php"><i class="fa fa-user"></i>Student Registration</a></li>
				<li><a href="../manage-students.php"><i class="fa fa-users"></i>Manage Students</a></li>
				<li><a href="Inventory.php"><i class="fa fa-desktop"></i>Inventory Management</a></li>
		</nav>
        <div class="content-wrapper">
            <div class="container-fluid">
                <br><br>
                <h2 >Stock Inventory</h2>

                <!-- Action Buttons -->
                <div class="text-center">
                    <a href="Add.php"><button>Add Information</button></a>   
                    <a href="Remove.php"><button>Remove Information</button></a> 
                    <a href="Change.php"><button>Change Information</button></a> 
                    <a href="SearchView.php"><button>Search Information</button></a> 
                    <a href="../dashboard.php"><button style="font-weight: bold; background-color: red; color: white;">EXIT</button></a>
                </div>

                <!-- Data Table -->
                <div class="table-responsive">
                    <table border="2">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ITEM</th>
                                <th>PRICE IN PESO</th>
                                <th>DESCRIPTION</th>
                                <th>STOCK QUANTITY</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($nilagay = mysqli_fetch_assoc($transport)) { ?>
                                <tr>
                                    <td><?php echo $nilagay["ID"]; ?></td>
                                    <td><?php echo $nilagay["ITEM"]; ?></td>
                                    <td><?php echo $nilagay["PRICE_IN_PESO"]; ?></td>
                                    <td><?php echo $nilagay["DESCRIPTION"]; ?></td>
                                    <td><?php echo $nilagay["STOCK_QUANTITY"]; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Include JS files -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/dataTables.bootstrap.min.js"></script>
</body>
</html>

<?php
// Close connection
mysqli_close($dbConnection);
?>
