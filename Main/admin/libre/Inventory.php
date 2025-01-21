<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
     body{
        background: url('shop.jpg') no-repeat center center fixed;
    background-size: cover;
     }
     h1{
        font-size: 45px;
    color: mintcream;
    text-transform: uppercase;
    display: inline-block;
     }

     
     button{
        font-size: 20px;
    padding: 5px 5px;
    background:mintcream;
    border-style: solid; 
    border-color: black;  
    color: black;
     }

    </style>
    <title>Document</title>
</head>
<body>
    <center><h1> STOCK INVENTORY </h1></br>

    <a href="Add.php"><button>Add information</button></a>   
    <a href="Remove.php"><button>Remove Information</button></a> 
    <a href="Change.php"><button>Change Information</button></a> 
    <a href="SearchView.php"><button>Search Information</button></a> 
    <a href="../dashboard.php"><button style="font-weight: bold; background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;">EXIT</button></a>
    </center>

</body>
</html>

<?php error_reporting(0);

$server="localhost"; 
$user="root"; 
$password="";
$ourdb= "SAMPLEONE";

$tulay = mysqli_connect($server, $user, $password, $ourdb);

$showsql= "SELECT * FROM Store";
$transport= mysqli_query($tulay, $showsql);


echo "<center><table border='2'>";
echo "<tr style='background: linear-gradient(skyblue, lightgreen); background-repeat: no-repeat;background-attachment: fixed;'> 
<td> ID </td>
<td> ITEM </td>
<td> PRICE IN PESO</td>
<td> SERIAL NUMBER</td>
<td> DESCRIPTION</td>
<td> ITEM TIME</td>
<td> STOCK QUANTITY</td>

</tr>";

while($nilagay= mysqli_fetch_assoc($transport)){ 
    echo "<tr style='background: linear-gradient(yellow, mintcream); background-repeat: no-repeat;background-attachment: fixed;'>";
    echo "<td>{$nilagay["ID"]} </td>";
    echo "<td>{$nilagay["ITEM"]} </td>";
    echo "<td>{$nilagay["PRICE_IN_PESO"]} </td>";
    echo "<td><center>{$nilagay["SERIAL_NUMBER"]} </center> </td>";
    echo "<td>{$nilagay["DESCRIPTION"]} </td>";
    echo "<td>{$nilagay["ITEM_TIME"]} </td>";
    echo "<td>{$nilagay["STOCK_QUANTITY"]} </td>";
    echo "</tr>";
}
echo "</table></center>"; 
?>