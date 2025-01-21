<?php
ob_start(); // Start output buffering

include('includes/config.php');
include('includes/checklogin.php');

$dbConnection = mysqli_connect($host, $dbuser, $dbpass, $db);

if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}

$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codeitem = $_POST["itemm"];
    $codeprice = $_POST["pricee"];
    $codedescription = $_POST["descriptionn"];
    $codestock = $_POST["stockk"];

    // Use prepared statements to prevent SQL injection
    $stmt = mysqli_prepare($dbConnection, "INSERT INTO Store (ITEM, PRICE_IN_PESO, DESCRIPTION, STOCK_QUANTITY) VALUES (?, ?, ?, ?)");

    if ($stmt) { // Check if prepare was successful
        mysqli_stmt_bind_param($stmt, "sdss", $codeitem, $codeprice, $codedescription, $codestock); // "s" for string, "d" for double

        if (mysqli_stmt_execute($stmt)) {
            $success_message = "Item added successfully!";
        } else {
            $error_message = "Error adding item: " . mysqli_error($dbConnection);
        }

        mysqli_stmt_close($stmt);
    } else {
        $error_message = "Error preparing statement: " . mysqli_error($dbConnection);
    }
}

mysqli_close($dbConnection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>
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
        .message{
            text-align: center;
            margin-top: 10px;
        }
        .success{
            color: green;
        }
        .error{
            color: red;
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
    </style>
</head>
<body>
    <?php include('includes/sidebar.php'); ?>
    <div class= "return-button">
    <a href="Inventory.php"><button>Return to Inventory</button></a>
    </div>
        <h1>STOCK INVENTORY: ADD</h1>

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
            <?php if ($success_message): ?>
                <div class="message success"><?php echo $success_message; ?></div>
            <?php elseif ($error_message): ?>
                <div class="message error"><?php echo $error_message; ?></div>
            <?php endif; ?>
        </form>
</body>
</html>
<?php ob_end_flush(); ?>
