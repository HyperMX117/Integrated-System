<?php
// connect.php (Example file where you connect to the DB)
require_once 'db_config.php'; // Adjust path if needed
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["collect_fee"])) {
    $studentId = $_POST["student_id"];
    $amountCollected = $_POST["amount_collected"];
    $collectionDate = $_POST["collection_date"];

    $sqlCollectFee = "INSERT INTO FeeCollection (StudentID, Amount, CollectionDate) VALUES (?, ?, ?)";
    $stmtCollectFee = $conn->prepare($sqlCollectFee);
    $stmtCollectFee->bind_param("ids", $studentId, $amountCollected, $collectionDate);

    if ($stmtCollectFee->execute()) {
    } else {
        echo "Error collecting fee: " . $stmtCollectFee->error;
    }

    $stmtCollectFee->close();
}

$sqlAllPayments = "SELECT s.Name, f.Amount, f.CollectionDate FROM FeeCollection f
                   JOIN Student s ON f.StudentID = s.StudentID";
$resultAllPayments = $conn->query($sqlAllPayments);

if ($resultAllPayments) {
    $allPayments = [];
    while ($rowPayment = $resultAllPayments->fetch_assoc()) {
        $allPayments[] = $rowPayment;
    }
} else {
    echo "Error fetching all payments: " . $conn->error;
}

$sqlStudents = "SELECT StudentID, Name FROM Student";
$resultStudents = $conn->query($sqlStudents);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management - Fee Collection</title>
    <style>
        body {
            background: url("images/bck.jpg") center/cover no-repeat fixed;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .fee-collection {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.8);
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);

        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, 0.5);
        }

        th {
            background: rgba(255, 255, 255, 0.9);
        }
    </style>
</head>
<body>

<div class="fee-collection">
    <h2>Fee Collection</h2>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="student_id">Select Student:</label>
        <select name="student_id" required>
            <?php
            while ($rowStudent = $resultStudents->fetch_assoc()) {
                echo '<option value="' . $rowStudent['StudentID'] . '">' . $rowStudent['Name'] . '</option>';
            }
            ?>
        </select>

        <label for="amount_collected">Enter Amount Collected:</label>
        <input type="number" name="amount_collected" required>

        <label for="collection_date">Collection Date:</label>
        <input type="date" name="collection_date" required>

        <button type="submit" name="collect_fee">Collect Fee</button>
    </form>

    <?php
    if (!empty($allPayments)) {
        echo '<h3>All Payments</h3>';
        echo '<table>';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Student Name</th>';
        echo '<th>Amount</th>';
        echo '<th>Collection Date</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($allPayments as $payment) {
            echo '<tr>';
            echo '<td>' . $payment['Name'] . '</td>';
            echo '<td>' . $payment['Amount'] . '</td>';
            echo '<td>' . $payment['CollectionDate'] . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }
    ?>
</div>

</body>
</html>
