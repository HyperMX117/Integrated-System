<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xtreme Adventure Tours</title>
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="CSS/header.css">
    <link rel="stylesheet" href="CSS/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header style="background-image: url('images/bgbg.jpg')">
        <div class="overlay-container">

            <!-- <div class="overlay-text">
                <h2>White Water Raft</h2>
            </div>
            <div class="overlay-text">
                <h2>White Water Raft Extreme</h2>
            </div>
            <div class="overlay-text">
                <h2>Kayaking</h2>
            </div>
            <div class="overlay-text">
                <h2>Hiking</h2>
            </div> -->
        </div>
        <div class="background-container">
            <div class="overlay-tile">
                <h1 class="slant-title" style="font-size:6vw ;">BOOKING ADVENTURES</h1>
                <h2 class="orange-text">Private Activities with Locals Tour Guides</h2>
                <!-- <h1 style="font-weight: bolder;">Trending 2024</h1> -->
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top p-0">
            <div class="container">
                <a class="logo navbar-brand" href="index.php">
                    <h1 class="title">EXTREME ADVENTURE TOURS</h1>
                </a>

                <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto text-center">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#xtremeAttractions">ADVENTURE PACKAGES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="aboutus.php">ABOUT US</a>
                        </li>

                        <div class="call-book d-flex">
                            <li class="nav-item">
                                <a class="btn btn-outline-light w-100" href="booking.php">BOOK NOW</a>
                            </li>
                            <li class="nav-item ms-auto text-center">
                                <a class="nav-link text-light" href="#" data-toggle="modal" data-target="#loginModal"><i
                                        class="fa-solid fa-user" style="color:black"></i></a>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div id="login-error-message" style="color: red;"></div>
                    <form id="login-form" action="login.php" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Enter your username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Enter your password" required>
                        </div><br>
                        <button type="submit" class="btn btn-outline-primary">Login</button>
                        <br></br>
                        <button class="btn btn-outline-secondary"><a href="forgetpage.php">Forget Password</a></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="xtremeAttractions" class="tours">
        <h2 class="p-3 text-center">OUR XTREME ATTRACTIONS</h2>

        <div class="container p-3 d-flex flex-column gap-4">
            <div class="attraction p-3 d-flex justify-content-center align-items-center gap-5">
                <div class="tour-img">
                    <img src="images/whitewater2.jpg" alt="">
                </div>
                <div class="tour-info d-flex align-items-center flex-column gap-4">
                    <h3>Class 1-2 Whitewater Rafting/Camping</h3>

                    <div class="tour-group d-flex justify-content-evenly w-100">
                        <div class="3days">
                            <h6>3 days tour</h6>
                            <p>Tour Number: 3WW12</p>
                            <p>Price: $100.00</p>
                        </div>
                        <div class="5days">
                            <h6>5 days tour</h6>
                            <p>Tour Number: 5WW12</p>
                            <p>Price: $145.00</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="attraction p-3 d-flex justify-content-center align-items-center gap-5">
                <div class="tour-img">
                    <img src="images/whiteraft.jpg" alt="">
                </div>
                <div class="tour-info d-flex align-items-center flex-column gap-4">
                    <h3>Class 3-4 Whitewater Rafting/Camping</h3>

                    <div class="tour-group d-flex justify-content-evenly w-100">
                        <div class="3days">
                            <h6>3 days tour</h6>
                            <p>Tour Number: 3WW34</p>
                            <p>Price: $125.00</p>
                        </div>
                        <div class="5days">
                            <h6>5 days tour</h6>
                            <p>Tour Number: 5WW34</p>
                            <p>Price: $175.00</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="attraction p-3 d-flex justify-content-evenly align-items-center gap-5">
                <div class="tour-img">
                    <img src="images/kayaking.jpg" alt="">
                </div>
                <div class="tour-info d-flex align-items-center flex-column gap-4">
                    <h3>Kayaking/Camping</h3>

                    <div class="tour-group d-flex justify-content-center w-100 gap-5">
                        <div class="3days">
                            <h6>3 days tour</h6>
                            <p>Tour Number: 3KC</p>
                            <p>Price: $70.00</p>
                        </div>
                        <div class="5days">
                            <h6>5 days tour</h6>
                            <p>Tour Number: 5KC</p>
                            <p>Price: $95.00</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="attraction p-3 d-flex justify-content-evenly align-items-center ">
                <div class="tour-img">
                    <img src="images/hiking.jpg" alt="">
                </div>
                <div class="tour-info d-flex align-items-center flex-column gap-4">
                    <h3>Hiking/Camping</h3>

                    <div class="tour-group d-flex justify-content-center w-100 gap-5">
                        <div class="3days">
                            <h6>3 days tour</h6>
                            <p>Tour Number: 3HC</p>
                            <p>Price: $50.00</p>
                        </div>
                        <div class="5days">
                            <h6>5 days tour</h6>
                            <p>Tour Number: 5HC</p>
                            <p>Price: $70.00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#login-btn").click(function () {
                $.ajax({
                    type: "POST",
                    url: "login.php",
                    data: $("#login-form").serialize(),
                    success: function (response) {
                        if (response === "success") {
                            window.location.href = "adminpage.php";
                        } else {
                            $("#login-error-message").html("Invalid credentials. Please try again.");
                        }
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $(".nav-link").on('click', function (event) {
                if (this.hash !== "") {
                    event.preventDefault();
                    var hash = this.hash;
    
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 800, function () {
                        window.location.hash = hash;
                    });
                }
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>