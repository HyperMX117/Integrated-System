<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

// Delete student record
if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    $adn = "DELETE FROM userregistration WHERE id=?"; // Corrected table name
    if ($stmt = $mysqli->prepare($adn)) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
        echo "<script>alert('Data Deleted');</script>";
        echo "<script>window.location.href = 'manage-students.php';</script>"; // Redirect after delete
    }
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
    <title>Manage Students</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript">
        var popUpWin = 0;

        function popUpWindow(URLStr, left, top, width, height) {
            if (popUpWin && !popUpWin.closed) popUpWin.close();
            popUpWin = open(URLStr, 'popUpWin', `toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=510,height=430,left=${left},top=${top},screenX=${left},screenY=${top}`);
        }
    </script>
</head>
<body>
    <?php include('includes/header.php'); ?>

    <div class="ts-main-content">
        <?php include('includes/sidebar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                    <br><br>
                        <h2 class="page-title">Manage Students</h2>
                        <div class="panel panel-default">
                            <div class="panel-heading">Student Details</div>
                            <div class="panel-body">
                                <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Sno.</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Gender</th>
                                            <th>Contact No</th>
                                            <th>Email</th>
                                            <th>Registration Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sno.</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Gender</th>
                                            <th>Contact No</th>
                                            <th>Email</th>
                                            <th>Registration Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $ret = "SELECT * FROM userregistration"; // Corrected table name
                                        if ($stmt = $mysqli->prepare($ret)) {
                                            $stmt->execute();
                                            $res = $stmt->get_result();
                                            $cnt = 1;
                                            while ($row = $res->fetch_object()) {
                                                echo "<tr>
                                                    <td>{$cnt}</td>
                                                    <td>{$row->firstName}</td>
                                                    <td>{$row->lastName}</td>
                                                    <td>{$row->gender}</td>
                                                    <td>{$row->contactNo}</td>
                                                    <td>{$row->email}</td>
                                                    <td>{$row->regDate}</td>
                                                    <td>
                                                        <a href='javascript:void(0);' onClick='popUpWindow(\"full-profile.php?id={$row->id}\");' title='View Full Details'>
                                                            <i class='fa fa-desktop'></i>
                                                        </a>&nbsp;&nbsp;
                                                        <a href='manage-students.php?del={$row->id}' title='Delete Record' onclick='return confirm(\"Do you want to delete?\");'>
                                                            <i class='fa fa-close'></i>
                                                        </a>
                                                    </td>
                                                </tr>";
                                                $cnt++;
                                            }
                                            $stmt->close();
                                        }
                                        ?>
                                    </tbody>
                                </table>
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
