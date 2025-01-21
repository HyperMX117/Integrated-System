<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

// Function to open popup window (moved outside HTML)
function popUpWindow($URLStr) {
    echo "<script>window.open('" . $URLStr . "', 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=510,height=430');</script>";
}
?>
<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <title>Room Details</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include('includes/header.php'); ?>

    <div class="ts-main-content">
        <?php include('includes/sidebar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-title">Rooms Details</h2>
                        <div class="panel panel-default">
                            <div class="panel-heading">All Room Details</div>
                            <div class="panel-body">
                                <table id="zctb" class="table table-bordered" cellspacing="0" width="100%">
                                    <tbody>
                                        <?php
                                        $aid = $_SESSION['login'];
                                        $ret = "SELECT * FROM registration WHERE emailid=?";
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->bind_param('s', $aid);
                                        $stmt->execute();
                                        $res = $stmt->get_result();

                                        while ($row = $res->fetch_object()) {
                                            $totalFee = $row->duration * $row->feespm;
                                            if ($row->foodstatus == 1) {
                                                $totalFee += 2000;
                                            }
                                        ?>
                                            <tr>
                                                <td colspan="4"><h4>Room Related Info</h4></td>
                                                <td><?php popUpWindow('full-profile.php?id=' . $row->emailid); ?>Print Data</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6"><b>Reg no. : <?php echo $row->postingDate; ?></b></td>
                                            </tr>
                                            <tr>
                                                <td><b>Room no :</b></td>
                                                <td><?php echo $row->roomno; ?></td>
                                                <td><b>Seater :</b></td>
                                                <td><?php echo $row->seater; ?></td>
                                                <td><b>Fees PM :</b></td>
                                                <td><?php echo $row->feespm; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Stay From :</b></td>
                                                <td><?php echo $row->stayfrom; ?></td>
                                                <td><b>Duration:</b></td>
                                                <td><?php echo $row->duration; ?> Months</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6"><b>Total Fee : <?php echo $totalFee; ?></b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6"><h4>Personal Info</h4></td>
                                            </tr>
                                            <tr>
                                                <td><b>Reg No. :</b></td>
                                                <td><?php echo $row->regno; ?></td>
                                                <td><b>Full Name :</b></td>
                                                <td><?php echo $row->firstName . ' ' . $row->lastName; ?></td>
                                                <td><b>Email :</b></td>
                                                <td><?php echo $row->emailid; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Contact No. :</b></td>
                                                <td><?php echo $row->contactno; ?></td>
                                                <td><b>Gender :</b></td>
                                                <td><?php echo $row->gender; ?></td>
                                                <td><b>Course :</b></td>
                                                <td><?php echo $row->course; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Emergency Contact No. :</b></td>
                                                <td><?php echo $row->egycontactno; ?></td>
                                                <td><b>Guardian Name :</b></td>
                                                <td><?php echo $row->guardianName; ?></td>
                                                <td><b>Guardian Relation :</b></td>
                                                <td><?php echo $row->guardianRelation; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Guardian Contact No. :</b></td>
                                                <td colspan="6"><?php echo $row->guardianContactno; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6"><h4>Addresses</h4></td>
                                            </tr>
                                            <tr>
                                                <td><b>Correspondense Address</b></td>
                                                <td colspan="2">
                                                    <?php echo $row->corresAddress; ?><br />
                                                    <?php echo $row->corresCIty; ?>, <?php echo $row->corresPincode; ?><br />
                                                    <?php echo $row->corresState; ?>
                                                </td>
                                                <td><b>Permanent Address</b></td>
                                                <td colspan="2">
                                                    <?php echo $row->pmntAddress; ?><br />
                                                    <?php echo $row->pmntCity; ?>, <?php echo $row->pmntPincode; ?><br />
                                                    <?php echo $row->pmnatetState; ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
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