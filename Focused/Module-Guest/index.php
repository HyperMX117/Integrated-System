<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Hostel Management</title>
        <link rel="shortcut icon" href="images/logopower.png" type="image/x-icon">
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="css/home.css">
        <link rel="stylesheet" href="css/modal.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    </head>

    <br>
    <header class="header" style="height: 80vh; background-image: linear-gradient(to right, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0)), url('images/bck.jpg'); background-position: center; background-size: cover; display: flex; justify-content: center; flex-direction: column;">
            <nav>
                <a href="index.php" class="logo">
                    <img src="images/logopower.png" alt="">
                    <div class="text-logo">
                        <p>Student</p>
                        <p>Hostel</p>
                        <p>Management</p>
                    </div>
                </a>
                
                <ul class="links">
                    <li><a href="#">Home</a></li>
                    <li><a href="student_login.php">Student Log In</a></li>

                    <!-- <li><a href="#" onclick="openModal()">Admin Login</a></li> -->
                    <li><a href="../admin"><i class="fa fa-user"></i>Admin Login</a></li>
                </ul>

                <div class="toggle-btn">
                    <i class="fa-solid fa-bars"></i>
                </div>
            </nav>
            <div class="dropdown-menu">
                <li><a href="#">Home</a></li>
                <li><a href="student_login.php">Student Log In</a></li>
                <!-- <li><a href="#" onclick="openModal()"> Admin Login</a></li> -->
                <li><a href="../"><i class="fa fa-user"></i>Admin Login</a></li>
            </div>

            <h5>PRIVATE HOSTEL ROOMS ARE AVAILABLE FOR <span style="color: red;">CONTINUING STUDENTS</span> AT THE FOLLOWING HOSTELS.</h5>

            <div class="image">
                <div class="text">
                    <h1>STUDENT HOSTEL</h1>
                    <h4>Affordable Rooms and Hostel Apartment</h4>
                </div>
            </div>
        </header>

        <div id="loginModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Admin Login</h2>
                <form id="loginForm" method="post" action="adminlogin.php">                   
                     <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
    
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
    
                    <button type="submit" >Login</button> <br> <br/>

                    <p class="signup-link"><a href="forgetpage.php">Forgot Password</a></p>
                </form>
            </div>
        </div>
        
        <div class="hostel-container">
            <div class="hostel">
                <img src="images/dorm1.jpeg" alt="">
                <div class="hostel-info">
                    <h3><i class="fa-solid fa-house"></i> Park Town</h3>
                    <p><i class="fa-solid fa-location-dot"></i> Modess </p>
                    <p class="available">Premium Beds</p>
                    <p class="available">8 Female beds available</p>
                </div>
            </div>

            <div class="hostel">
                <img src="images/dorm2.jpeg" alt="">
                <div class="hostel-info">
                    <h3><i class="fa-solid fa-house"></i> Green Door</h3>
                    <p><i class="fa-solid fa-location-dot"></i> Paranaque</p>
                    <p class="available">Luxury Loft-type Beds</p>
                    <p class="available">2 beds available</p>
                </div>
            </div>

            <div class="hostel">
                <img src="images/dorm3.jpeg" alt="">
                <div class="hostel-info">
                    <h3><i class="fa-solid fa-house"></i> Sog-U Mabini</h3>
                    <p><i class="fa-solid fa-location-dot"></i> BGC</p>
                    <p class="available">Economy Loft-type Beds</p>
                    <p class="available">3 Female beds available</p>
                </div>
            </div>
        </div>

        <script src="script.js"></script>
    </body>
</html>
