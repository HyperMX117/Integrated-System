<?php
session_start();
include('includes/config.php');
if(isset($_POST['login']))
{
$username=$_POST['username'];
$password=$_POST['password'];
$stmt=$mysqli->prepare("SELECT username,email,password,id FROM admin WHERE (userName=?|| email=?) and password=? ");
				$stmt->bind_param('sss',$username,$username,$password);
				$stmt->execute();
				$stmt -> bind_result($username,$username,$password,$id);
				$rs=$stmt->fetch();
				$_SESSION['id']=$id;
				$uip=$_SERVER['REMOTE_ADDR'];
				$ldate=date('d/m/Y h:i:s', time());
				if($rs)
				{
                //  $insert="INSERT into admin(adminid,ip)VALUES(?,?)";
   // $stmtins = $mysqli->prepare($insert);
   // $stmtins->bind_param('sH',$id,$uip);
    //$res=$stmtins->execute();
					header("location:admin-profile.php");
				}

				else
				{
					echo "<script>alert('Invalid Username/Email or password');</script>";
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

    <title>Admin login</title>

    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .foot {
            text-align: center;
            border: 1px solid black;
            padding: 10px;
            margin-top: 20px;
            background-color: rgb(0, 0, 0);
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 100px auto;
            max-width: 400px;
        }

        /* FIX: Set input text color */
        .form-container input[type="text"],
        .form-container input[type="password"] {
            color: black;
        }
        /* OR ALTERNATIVELY, adjust background opacity:
        .form-container {
            background-color: rgba(255, 255, 255, 0.5); 
        }
        */

        .login {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }

        .login:hover {
            background-color: #0056b3;
        }

        .containers {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
        }

        .bk-img {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        body {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="containers" style="background-image: url(img/bg2.jpg);">
        <div class="login-page bk-img form-container">
            <h1>Hostel Management System</h1>

            <?php if (isset($errorMessage)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>

            <form action="" method="post" class="mt">
                <label for="" class="text-uppercase text-sm">Your Username or Email</label>
                <input type="text" placeholder="Username or Email" name="username" class="form-control mb" required>
                <label for="" class="text-uppercase text-sm">Password</label>
                <input type="password" placeholder="Password" name="password" class="form-control mb" required>

                <input type="submit" name="login" class="login" value="Login">
            </form>
        </div>

        <div class="foot">
            <footer>
                <p> Brought To You By <a href="https://code-projects.org/">Code-Projects</a></p>
            </footer>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>