<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-image: url('images/hiking.jpg');
            background-size: cover;
            opacity: 1;
        }
    </style>
</head>

<body>
    <h1>Data Dashboard</h1>

    <?php
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'booking_system';

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Count of Booked Reservations
    $bookedQuery = "SELECT COUNT(*) as booked_count FROM bookings";
    $bookedResult = $conn->query($bookedQuery);
    $bookedData = $bookedResult->fetch_assoc();
    $bookedCount = $bookedData['booked_count'];

    // Number of People per Booking
    $peopleQuery = "SELECT people FROM bookings";
    $peopleResult = $conn->query($peopleQuery);
    $peopleData = $peopleResult->fetch_all(MYSQLI_ASSOC);
    $peopleCounts = array_count_values(array_column($peopleData, 'people'));

    // Most Booked Tours
    $tourQuery = "SELECT tour, COUNT(*) as tour_count FROM bookings GROUP BY tour";
    $tourResult = $conn->query($tourQuery);
    $tourData = $tourResult->fetch_all(MYSQLI_ASSOC);
    $tourLabels = array_column($tourData, 'tour');
    $tourCounts = array_column($tourData, 'tour_count');

    // Total Sales
    $totalSalesQuery = "SELECT SUM(total_price) as total_sales FROM bookings";
    $totalSalesResult = $conn->query($totalSalesQuery);
    $totalSalesData = $totalSalesResult->fetch_assoc();
    $totalSales = $totalSalesData['total_sales'];

    $conn->close();
    ?>

    <div style="width: 30%; display: inline-block;">
        <h3>Count of Booked Reservations</h3>
        <canvas id="bookedChart"></canvas>
    </div>

    <div style="width: 30%; display: inline-block;">
        <h3>Number of People per Booking</h3>
        <canvas id="peopleChart"></canvas>
    </div>

    <div style="width: 30%; display: inline-block;">
        <h3>Most Booked Tours</h3>
        <canvas id="tourChart"></canvas>
    </div>

    <div style="width: 20%; display: inline-block;">
        <h3>Total Sales</h3>
        <canvas id="totalSalesChart"></canvas>
    </div>

    <script>
        var bookedData = {
            labels: ['Booked'],
            datasets: [{
                label: 'Count',
                data: [<?php echo $bookedCount; ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 1)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        };

        var peopleData = {
            labels: <?php echo json_encode(array_keys($peopleCounts)); ?>,
            datasets: [{
                label: 'Number of People',
                data: <?php echo json_encode(array_values($peopleCounts)); ?>,
                backgroundColor: 'rgba(60, 179, 113)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        var tourData = {
            labels: <?php echo json_encode($tourLabels); ?>,
            datasets: [{
                label: 'Tour Count',
                data: <?php echo json_encode($tourCounts); ?>,
                backgroundColor: 'rgba(153, 102, 255, 1)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        };

        var options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        var bookedCtx = document.getElementById('bookedChart').getContext('2d');
        var bookedChart = new Chart(bookedCtx, {
            type: 'bar',
            data: bookedData,
            options: options
        });

        var peopleCtx = document.getElementById('peopleChart').getContext('2d');
        var peopleChart = new Chart(peopleCtx, {
            type: 'bar',
            data: peopleData,
            options: options
        });

        var tourCtx = document.getElementById('tourChart').getContext('2d');
        var tourChart = new Chart(tourCtx, {
            type: 'bar',
            data: tourData,
            options: options
        });
        var totalSalesData = {
        labels: ['Total Sales'],
        datasets: [{
            label: 'Total Sales',
            data: [<?php echo $totalSales; ?>],
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 165, 0)',
            borderWidth: 2
        }]
    };

    var totalSalesOptions = {
        scale: {
            ticks: {
                beginAtZero: true
            }
        }
    };

    var totalSalesCtx = document.getElementById('totalSalesChart').getContext('2d');
    var totalSalesChart = new Chart(totalSalesCtx, {
        type: 'polarArea',
        data: totalSalesData,
        options: totalSalesOptions
    });
    </script>
</body>

</html>