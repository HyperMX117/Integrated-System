<?php
ob_start(); // Start output buffering

$server = "localhost";
$user = "root";
$password = "";
$ourdb = "SAMPLEONE";

$tulay = mysqli_connect($server, $user, $password, $ourdb);

if (!$tulay) {
    die("Connection failed: " . mysqli_connect_error());
}

$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codeitem = $_POST["itemm"];
    $codeprice = $_POST["pricee"];
    $codeserial = $_POST["seriall"];
    $codedescription = $_POST["descriptionn"];
    $codestock = $_POST["stockk"];

    // Use prepared statements to prevent SQL injection
    $stmt = mysqli_prepare($tulay, "INSERT INTO Store (ITEM, PRICE_IN_PESO, SERIAL_NUMBER, DESCRIPTION, STOCK_QUANTITY) VALUES (?, ?, ?, ?, ?)");

    if ($stmt) { // Check if prepare was successful
        mysqli_stmt_bind_param($stmt, "sdssd", $codeitem, $codeprice, $codeserial, $codedescription, $codestock); // "s" for string, "d" for double

        if (mysqli_stmt_execute($stmt)) {
            $success_message = "Item added successfully!";
        } else {
            $error_message = "Error adding item: " . mysqli_error($tulay);
        }

        mysqli_stmt_close($stmt);
    } else {
        $error_message = "Error preparing statement: " . mysqli_error($tulay);
    }
}

mysqli_close($tulay);
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
            font-family: sans-serif; /* Added a default font */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            justify-content: center; /* Center vertically */
            align-items: center; /* Center horizontally */
        }

        form {
            width: 300px;
            background: rgba(0, 0, 0, 0.5);
            padding: 30px; /* Reduced padding */
            border-radius: 8px; /* Added border-radius */
            box-sizing: border-box; /* Include padding in width */
        }

        form label {
            display: block;
            color: white;
            text-transform: uppercase;
            margin-bottom: 5px; /* Added spacing between label and input */
        }

        form input[type="text"] { /* Style only text inputs */
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
            text-align: center; /* Center the heading */
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
<div class="return-button">
<a href="Inventory.php"><button>Return to Inventory</button></a>
</div>
    <h1>STOCK INVENTORY: ADD</h1>

    <form action="Add.php" method="post">
        <label for="itemm">Input Item</label>
        <input type="text" name="itemm" id="itemm" required>

        <label for="pricee">Input Price in Peso</label>
        <input type="text" name="pricee" id="pricee" required>

        <label for="seriall">Input Serial Number</label>
        <input type="text" name="seriall" id="seriall" required>

        <label for="descriptionn">Input Description</label>
        <input type="text" name="descriptionn" id="descriptionn" required>

        <label for="stockk">Input Stock Quantity</label>
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