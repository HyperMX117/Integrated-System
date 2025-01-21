<?php
session_start();

// Set includes relative path
$includesRelPath = '../includes';
$includesPath = realpath(dirname(__FILE__) . '/' . $includesRelPath);

if (!$includesPath) {
    die("Error: Could not determine includes path.");
}

// Include necessary files
$configPath = $includesPath . '/config.php';
$checkloginPath = $includesPath . '/checklogin.php';

if (!file_exists($configPath)) {
    die('Error: config.php not found!');
}
if (!file_exists($checkloginPath)) {
    die('Error: checklogin.php not found!');
}

include($configPath);
include($checkloginPath);

// Ensure user is logged in
check_login();

// Handle deletion (unchanged)
if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    $adn = "DELETE FROM foodmenu WHERE id = ?";
    $stmt = $mysqli->prepare($adn);

    if ($stmt) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
        echo "<script>alert('Data Deleted');</script>";
    } else {
        die('Error: Unable to prepare statement.');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            background-color: #f0f4f8;
        }

        .main-container {
            display: flex;
            width: 100%;
            height: 100%;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 20%;
            background-color: #0073e6;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 0;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .nav-button {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            margin: 10px 0;
            text-align: center;
            border-radius: 5px;
            width: 80%;
            background-color: transparent;
            transition: background-color 0.3s, color 0.3s;
        }

        .nav-button:hover {
            background-color: #005bb5;
        }

        .nav-button.active {
            background-color: white;
            color: #0073e6;
            font-weight: bold;
        }

        /* Content Section Styles */
        .content {
            width: 80%;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start; /* Align content to the top */
            overflow-y: auto; /* Add scrollbar if content overflows */
        }

        .welcome-section, .menu-header {
            text-align: center;
            width: 100%; /* Make sure header takes full width */
            margin-bottom: 20px; /* Add some space below the header */
        }

        h1, h2 {
            margin: 0;
            color: #0073e6;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Responsive grid */
            gap: 20px;
            width: 100%; /* Make grid take full width */
        }

        .menu-item {
            text-align: center;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            box-sizing: border-box; /* Include padding in width calculation */
        }

        .menu-item img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .menu-item p {
            margin: 0;
            color: #0073e6;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <nav class="sidebar">
            <a href="index.php" class="nav-button <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo 'active'; ?>">WELCOME</a>
            <a href="menu.php" class="nav-button <?php if (basename($_SERVER['PHP_SELF']) == 'menu.php') echo 'active'; ?>">MEALS</a>
            <a href="../dashboard.php" class="nav-button">EXIT</a>
        </nav>
        <div class="content">
            <div class="menu-header">
                <h1>MENU</h1>
            </div>
            <div class="menu-grid">
                <?php
                $ret = "SELECT * FROM foodmenu";
                $stmt = $mysqli->prepare($ret);

                if ($stmt) {
                    $stmt->execute();
                    $res = $stmt->get_result();

                    while ($row = $res->fetch_object()) {
                        for ($i = 1; $i <= 5; $i++) {
                            $itemName = $row->{'it' . $i};
                            if (!empty($itemName)) {
                                echo "<div class='menu-item'>";
                                $imagePath = "images/" . str_replace(' ', '', $itemName) . ".png";
                                if (!file_exists($imagePath)) {
                                    $imagePath = "images/placeholder.png";
                                }
                                echo "<img src='" . htmlspecialchars($imagePath, ENT_QUOTES) . "' alt='" . htmlspecialchars($itemName, ENT_QUOTES) . "'>";
                                echo "<p>" . htmlspecialchars($itemName, ENT_QUOTES) . "</p>";
                                echo "</div>";
                            }
                        }
                    }
                    $stmt->close();
                } else {
                    echo "<p>Error: Unable to retrieve menu items.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>