<?php
session_start();
include('includes/config.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT id, email FROM userregistration WHERE email = ? AND password = ?");
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $email);
        $stmt->fetch();
        $_SESSION['id'] = $id;
        $_SESSION['login'] = $email;

        header("location:dashboard.php");
    } else {
        echo "<script>alert('Invalid Username/Email or Password');</script>";
    }

    $stmt->close();
}
?>

<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <title>User Hostel Registration</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="ts-main-content">
        <?php include('includes/sidebar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid" style="background-image: url(img/bgimg.webp);">
                <div class="login-page bk-img form-container">
                    <h2 class="page-title">User Login</h2>
                    <form action="" method="post" class="mt">
                        <label class="text-uppercase text-sm">Email</label>
                        <input type="text" placeholder="Email" name="email" class="form-control mb" required>
                        <label class="text-uppercase text-sm">Password</label>
                        <input type="password" placeholder="Password" name="password" class="form-control mb" required>
                        <input type="submit" name="login" class="login" value="Login">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
