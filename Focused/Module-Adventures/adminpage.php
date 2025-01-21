<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Xtreme Tours Admin Panel</title>
  <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      overflow: hidden; 
    }

    #sidebar {
      height: 100%;
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      background: url('images/backg.jpg') center center no-repeat;
      background-size: cover;
      padding-top: 20px;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); 
    }

    #sidebar a {
      padding: 15px 20px;
      text-decoration: none;
      font-size: 18px;
      color: #000;
      display: flex;
      align-items: center;
      transition: 0.3s;
    }

    #sidebar a i {
      margin-right: 10px;
    }

    #sidebar a:hover {
      background-color: rgba(0, 0, 0, 0.3);
    }

    #content {
      margin-left: 250px;
      padding: 20px;
      overflow: auto; 
      height: 100vh; 
    }

    iframe {
      width: 100%;
      height: 100%;
      border: none;
    }

    #change-password-section {
      padding: 20px;
      background-color: #444;
      color: #fff;
      margin-top: 20px;
    }

    #logo {
      margin-bottom: 20px;
    }

    button {
      background-color: #c62828;
      color: #fff;
      border: none;
      padding: 10px 15px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
      margin-top: 20px;
    }

    button:hover {
      background-color: #b71c1c;
    }
  </style>
</head>
<body>

  <div id="sidebar">
    <div id="logo">
      <img src="images/logo.png" alt="Logo" width="200" height="100">
    </div>
    <a href="dashboard.php" target="contentFrame"><i class="fas fa-home"></i> Dashboard</a>
    <a href="customer.php" target="contentFrame"><i class="fas fa-user"></i> Customer</a>
    <a href="register.php" target="contentFrame"><i class="fas fa-key"></i> Register Admin</a>
    <button onclick="logOut()">Log Out</button>
  </div>

  <div id="content">
    <iframe src="dashboard.php" name="contentFrame"></iframe>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
  <script>
    function logOut() {
      window.location.href = 'index.php';
    }
  </script>

</body>
</html>
