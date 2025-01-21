<?php
ob_start(); // Start output buffering

$server = "localhost";
$user = "root";
$password = "";
$ourdb = "integrateddb";

$dbConnection = mysqli_connect($server, $user, $password, $ourdb);

if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}

$error_message = "";
$results = []; // Initialize an empty array to store results

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchRow = $_POST["searchh"];

    if (empty($searchRow)) {
        $error_message = "Please enter an item name to search.";
    } else {
        // Use prepared statements to prevent SQL injection (CRITICAL)
        $stmt = mysqli_prepare($dbConnection, "SELECT * FROM Store WHERE ITEM LIKE ?");
        $searchPattern = "%" . $searchRow . "%"; // Add wildcards for LIKE
        mysqli_stmt_bind_param($stmt, "s", $searchPattern);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $results[] = $row; // Store results in the array
                }
            } else {
                $error_message = "No items found matching your search.";
            }
            mysqli_stmt_close($stmt);
        } else {
            $error_message = "Error executing query: " . mysqli_error($dbConnection);
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
    <title>Search Item</title>
    <style>
        body {
            background: url('shop.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            justify-content: center;
            align-items: center;
        }

        form {
            width: 300px;
            background: rgba(0, 0, 0, 0.5);
            padding: 30px;
            border-radius: 8px;
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
        form input[type="submit"]{
            width: 100%;
            padding: 10px;
            background-color: mintcream;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        h1 {
            font-size: 45px;
            color: mintcream;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 80%; /* Adjust as needed */
            border-collapse: collapse;
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.7); /* Semi-transparent white background */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        .return-button{
            position: absolute;
            top: 10px;
            left: 10px;
        }
         .return-button button{
            padding: 10px 20px;
            background-color: mintcream;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        .message{
            text-align: center;
            margin-top: 10px;
        }
        .error{
            color: red;
        }
    </style>
</head>
<body>
<div class="return-button">
<a href="Inventory.php"><button>Return to Inventory</button></a>
</div>
    <h1>STOCK INVENTORY: SEARCH</h1>
    <form action="SearchView.php" method="post">
        <label for="searchh">Input Item Name to Search</label>
        <input type="text" name="searchh" id="searchh" required>
        <input type="submit" value="CONFIRM">
        <?php if ($error_message): ?>
            <div class="message error"><?php echo $error_message; ?></div>
        <?php endif; ?>
    </form>
    <?php if (!empty($results)): ?>
        <center>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Item</th>
                        <th>Price in Peso</th>
                        <th>Serial Number</th>
                        <th>Description</th>
                        <th>Item Time</th>
                        <th>Stock Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?php echo $row["ID"]; ?></td>
                            <td><?php echo $row["ITEM"]; ?></td>
                            <td><?php echo $row["PRICE_IN_PESO"]; ?></td>
                            <td align="center"><?php echo $row["SERIAL_NUMBER"]; ?></td>
                            <td><?php echo $row["DESCRIPTION"]; ?></td>
                            <td><?php echo $row["ITEM_TIME"]; ?></td>
                            <td><?php echo $row["STOCK_QUANTITY"]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </center>
    <?php endif; ?>
</body>
</html>
<?php ob_end_flush(); ?>