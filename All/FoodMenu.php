<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

if (isset($_POST['submit'])) {
    $roomno = $_POST['room'];
    $email = $_POST["email"];

    $stmt_count = $mysqli->prepare("SELECT COUNT(id) AS total FROM booking_room WHERE room_no = ?");
    $stmt_seater = $mysqli->prepare("SELECT seater FROM rooms WHERE room_no = ?");
    $stmt_insert = $mysqli->prepare("INSERT INTO booking_room (room_no, user_email) VALUES (?, ?)");

    if (!$stmt_count || !$stmt_seater || !$stmt_insert) {
        die("Prepare failed: " . $mysqli->error);
    }

    $stmt_count->bind_param("s", $roomno);
    $stmt_seater->bind_param("s", $roomno);

    if (!$stmt_count->execute() || !$stmt_seater->execute()) {
        die("Execute failed: " . $stmt_count->error . " or " . $stmt_seater->error);
    }

    $result_count = $stmt_count->get_result();
    $result_seater = $stmt_seater->get_result();

    if (!$result_count || !$result_seater) {
        die("Get result failed: " . $stmt_count->error . " or " . $stmt_seater->error);
    }

    $t = $result_count->fetch_assoc();
    $s = $result_seater->fetch_assoc();

    if (!$t || !$s) {
        die("Fetch assoc failed. Possible issue with query or no data returned.");
    }

    $total_booked = $t['total'];
    $total_seats = $s['seater'];
    $available_seats = $total_seats - $total_booked;

    // VERY IMPORTANT: Free the result sets
    $result_count->free_result();
    $result_seater->free_result();

    if ($available_seats > 0) {
        $stmt_insert->bind_param("ss", $roomno, $email);
        if ($stmt_insert->execute()) {
            $_SESSION['msg'] = "Student successfully registered.";
        } else {
            $_SESSION['msg'] = "Error registering student: " . $stmt_insert->error;
        }
    } else {
        $_SESSION['msg'] = "No seats available in this room.";
    }

    $stmt_count->close();
    $stmt_seater->close();
    $stmt_insert->close();

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <title>Users Hostel Registration</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
    <script type="text/javascript" src="js/validation.min.js"></script>
    <script>
        function getSeater(val) {
            $.ajax({
                type: "POST",
                url: "get_seater.php", // Make sure this path is correct
                data: 'roomid=' + val,
                success: function(data) {
                    $('#seater').val(data);
                }
            });

            $.ajax({
                type: "POST",
                url: "get_seater.php", // Same path, but different data?
                data: 'rid=' + val,
                success: function(data) {
                    $('#fpm').val(data);
                }
            });
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
                        <h2 class="page-title">Hostel Registration</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">Fill all Info</div>
                                    <div class="panel-body">
                                        <form method="post" class="form-horizontal">
                                            <?php
                                            $uid = $_SESSION['login'];
                                            $stmt = $mysqli->prepare("SELECT emailid FROM registration WHERE emailid=?");
                                            $stmt->bind_param('s', $uid);
                                            $stmt->execute();
                                            $stmt->store_result();
                                            if ($stmt->num_rows > 0) {
                                                echo "<h3 style='color: red' align='left'>Hostel already booked by you</h3>";
                                            }
                                            $stmt->close();
                                            ?>
                                            <?php if (isset($_SESSION['msg'])) : ?>
                                                <p style="color: <?php echo (strpos($_SESSION['msg'], 'Error') !== false) ? 'red' : 'green'; ?>">
                                                    <?php echo htmlentities($_SESSION['msg']);
                                                    unset($_SESSION['msg']);
                                                    ?>
                                                </p>
                                            <?php endif; ?>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Room No.</label>
                                                <div class="col-sm-8">
                                                    <select name="room" id="room" class="form-control" onChange="getSeater(this.value);" required>
                                                        <option value="">Select Room</option>
                                                        <?php
                                                        $query = "SELECT room_no FROM rooms";
                                                        $stmt2 = $mysqli->prepare($query);
                                                        $stmt2->execute();
                                                        $res = $stmt2->get_result();
                                                        while ($row = $res->fetch_object()) {
                                                            echo "<option value='" . $row->room_no . "'>" . $row->room_no . "</option>";
                                                        }
                                                        $stmt2->close();
                                                        ?>
                                                    </select>
                                                    <span id="room-availability-status" style="font-size:12px;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Seater</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="seater" id="seater" class="form-control" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Fees Per Month</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="fpm" id="fpm" class="form-control" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Email</label>
                                                <div class="col-sm-8">
                                                    <input type="email" name="email" id="email" class="form-control" required value="<?php echo $_SESSION['login']; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-sm-offset-4">
                                                <button class="btn btn-default" type="reset">Cancel</button>
                                                <input type="submit" name="submit" value="Register" class="btn btn-primary">
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
    <script src="js/dataTables.bootstrap.min.js
	<script src="js/Chart.min.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/main.js"></script>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        $('input[type="checkbox"]').click(function() {
            if ($(this).prop("checked") == true) {
                $('#paddress').val($('#address').val());
                $('#pcity').val($('#city').val());
                $('#pstate').val($('#state').val());
                $('#ppincode').val($('#pincode').val());
            }

        });
    });
</script>
<script>
    function checkAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "check_availability.php",
            data: 'roomno=' + $("#room").val(),
            type: "POST",
            success: function(data) {
                $("#room-availability-status").html(data);
                $("#loaderIcon").hide();
            },
            error: function() {} // Handle errors if needed
        });
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#duration').keyup(function() {
            var fetch_dbid = $(this).val();
            $.ajax({
                type: 'POST',
                url: "ins-amt.php?action=userid", // Make sure this path is correct
                data: {
                    userinfo: fetch_dbid
                },
                success: function(data) {
                    $('.result').val(data);
                }
            });

        })
    });
</script>

</html>