<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management - Personal Overview</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: url("images/Day1.webp") center/cover no-repeat fixed;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .personal-overview {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
        }

        h2 {
            text-align: center;
            color: #3498db;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        th {
            background: rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body>

<div class="personal-overview">
    <h2>Personal Overview</h2>

    <table>
        <tr>
            <th>Student ID</th>
            <td>123456</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>John Doe</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>john.doe@example.com</td>
        </tr>
        <tr>
            <th>Room Number</th>
            <td>101</td>
        </tr>
        <tr>
            <th>Occupancy</th>
            <td>2/4</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>Occupied</td>
        </tr>
    </table>
</div>

</body>
</html>
