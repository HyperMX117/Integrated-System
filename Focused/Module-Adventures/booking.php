<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xtreme Adventure Tours</title>
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="CSS/booking.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<header>
            <a href="index.php">
                <img src="images/logo.png" alt="Xtreme Adventure Tours Logo">
            </a>
        </header>
<body style=" background-image: url('images/back2.jpg')">
    <div class="glass-container">
        <div class="booking-form">
            <h2>Booking Form</h2>
            <form action="submit.php" method="post" onsubmit="submitForm(event)">
                <div class="input-group">
                    <div class="input-block">
                        <input type="text" id="name" name="name" placeholder=" " required>
                        <label for="firstName">First Name</label>
                    </div>
                    <div class="input-block">
                        <input type="text" id="lastName" name="lastName" placeholder=" " required>
                        <label for="lastName">Last Name</label>
                    </div>
                </div>

                <div class="input-block">
                    <input type="email" id="email" name="email" placeholder=" " required>
                    <label for="email">Email</label>
                </div>

                <div class="select-block">
                    <select id="region" name="region" onchange="updateProvinces()" required></select>
                    <label for="region" class="label">Region</label>
                </div>

                <div class="select-block">
                    <select id="province" name="province" onchange="updateCities()" required>
                        <option value="">Select Province</option>
                    </select>
                    <label for="province" class="label">Province</label>
                </div>

                <div class="select-block">
                    <select id="city" name="city" required>
                        <option value="">Select City</option>
                    </select>
                    <label for="city" class="label">City</label>
                </div>

                <div class="input-block">
                    <input type="text" id="streetAddress" name="streetAddress" placeholder=" ">
                    <label for="streetAddress">Barangay and Street Address</label>
                </div>

                <div class="input-group">
                    <div class="select-block">
                        <select id="tour-length" name="tour-length" required>
                            <option value="">Select Tour Length</option>
                            <option value="3days">3 Days Tour</option>
                            <option value="5days">5 Days Tour</option>
                        </select>
                        <label for="tour-length">Tour Length</label>
                    </div>
                    <div class="input-block">
                        <input type="number" name="people" id="people" placeholder=" " required>
                        <label for="people">Number of People</label>
                    </div>
                </div>

                <div class="select-block">
                    <select name="tour" id="tour" name="tour" required onchange="updatePricesAndCode()">
                        <option value="">Select Tour</option>
                        <option value="class1-2">Class 1-2 Whitewater Rafting/Camping</option>
                        <option value="class3-4">Class 3-4 Whitewater Rafting/Camping</option>
                        <option value="kayaking/camping">Kayaking/Camping</option>
                        <option value="hiking/camping">Hiking/Camping</option>
                    </select>
                    <label for="tour" class="label">Tour</label>
                </div>

                <div id="prices"></div>
                <div id="tourCode"></div>

                <div class="select-block">
                    <label for="paymentMethod" class="label">Payment Method</label>
                    <select id="paymentMethod" name="paymentMethod" required>
                    <option value="">Select Payment</option>
                    <option value="gcash">Gcash</option>
                    </select>
                </div>
                <div id="qrCodeContainer"></div>
                <div class="input-block-date">
                    <input type="date" id="date" name="date" required>
                    <label for="date">Preferred Date</label>
                </div>
                <button type="submit">Book Now</button>
                
            </form>
        </div>
    </div>

    <div class="tour">
        <div class="glass-container">
            <img src="images/whitewater2.jpg" alt="">
            <div class="card-body">
                <h3>Class 1-2 Whitewater Rafting/Camping</h3>
                <div class="card-info">
                    <div class="3days">
                        <h5>3 days tour</h5>
                        <p>Tour Number: 3WW12</p>
                        <p>Price: $100.00</p>
                    </div>
                    <div class="5days">
                        <h5>5 days tour</h5>
                        <p>Tour Number: 5WW12</p>
                        <p>Price: $145.00</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="glass-container">
            <img src="images/whiteraft.jpg" alt="">
            <div class="card-body">
                <h3>Class 3-4 Whitewater Rafting/Camping</h3>
                <div class="card-info">
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

        <div class="glass-container">
            <img src="images/kayaking.jpg" alt="">
            <div class="card-body">
                <h3>Kayaking/Camping</h3>
                <div class="card-info">
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

        <div class="glass-container">
            <img src="images/hiking.jpg" alt="">
            <div class="card-body">
                <h3>Hiking/Camping</h3>
                <div class="card-info">
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
    <script src="gcash.js"></script>
    <script src="prices.js"></script>
    <script src="cities.js"></script>
</body>

</html>