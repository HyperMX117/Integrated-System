<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

if (isset($_POST['fsubmit'])) {
    $Day = $_POST['day'];
    $item1 = $_POST['itm1'];
    $item2 = $_POST['itm2'];
    $item3 = $_POST['itm3'];
    $item4 = $_POST['itm4'];
    $item5 = $_POST['itm5'];

    // Check for existing item (using prepared statement)
    $stmt1 = $mysqli->prepare("SELECT it1 FROM foodmenu WHERE day = ? AND it1 = ?");
    if ($stmt1 === false) {
        die("Prepare failed: " . $mysqli->error);
    }
    $stmt1->bind_param("ss", $Day, $item1);
    if (!$stmt1->execute()) {
        die("Execute failed: " . $stmt1->error);
    }
    $stmt1->store_result();

    if ($stmt1->num_rows > 0) {
        $_SESSION['msg'] = "Food item '$item1' already exists for this day.";
    } else {
        // Insert new item (using prepared statement)
        $stmt = $mysqli->prepare("INSERT INTO foodmenu (day, it1, it2, it3, it4, it5) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $mysqli->error);
        }
        $stmt->bind_param("ssssss", $Day, $item1, $item2, $item3, $item4, $item5);

        if ($stmt->execute()) {
            $_SESSION['msg'] = "Food item '$item1' added successfully.";
        } else {
            $_SESSION['msg'] = "Error adding food: " . $stmt->error;
        }
        $stmt->close();
    }
    $stmt1->close();
    header("Location: " . $_SERVER['PHP_SELF']); // Redirect to clear form
    exit();
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">
    <title>Add Food</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
    <script type="text/javascript" src="js/validation.min.js"></script>
</head>

<body>
    <?php include('includes/header.php'); ?>
    <div class="ts-main-content">
        <?php include('includes/sidebar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-title">Add a food</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Add a food</div>
                                    <div class="panel-body">
                                        <?php if (isset($_SESSION['msg'])) : ?>
                                            <p style="color: <?php echo (strpos($_SESSION['msg'], 'Error') !== false) ? 'red' : 'green'; ?>">
                                                <?php echo htmlentities($_SESSION['msg']);
                                                unset($_SESSION['msg']); // Clear message after display
                                                ?>
                                            </p>
                                        <?php endif; ?>
                                        <form method="post" class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Select Day</label>
                                                <div class="col-sm-8">
                                                    <select name="day" class="form-control" required>
                                                        <option value="">Select Day</option>
                                                        <?php for ($i = 1; $i <= 7; $i++) : ?>
                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?>st/nd/rd/th Day</option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Item No-<?php echo $i; ?></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="itm<?php echo $i; ?>" id="itm<?php echo $i; ?>" value="" required="required">
                                                    </div>
                                                </div>
                                            <?php endfor; ?>

                                            <div class="col-sm-8 col-sm-offset-2">
                                                <button class="btn btn-primary" type="submit" name="fsubmit">Create Items</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/main.js"></script>

</body>

</html>