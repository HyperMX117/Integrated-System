<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hostel Management Admin Panel</title>
  <link rel="shortcut icon" href="images/logopower.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #f4f4f4;
    }

    #sidebar {
      height: 100%;
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #3C0753;
      padding-top: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      background: url("images/Day1.webp")center/cover no-repeat fixed;
      ;
    }

    #sidebar a {
      padding: 15px 20px;
      text-decoration: none;
      font-size: 18px;
      color: #fff;
      display: flex;
      align-items: center;
      transition: 0.3s;
    }

    #sidebar a:hover {
      background-color: #FFD700;
    }

    #sidebar button {
      margin-top: 20px;
      padding: 10px 20px;
      background-color: transparent;
      color: #fff;
      border: none;
      cursor: pointer;
      font-size: 16px;
      transition: 0.3s;
      display: flex;
      align-items: center;
    }

    #sidebar button:hover {
      background-color: #FFD700;
    }


    #clickEffect {
      position: absolute;
      background-color: transparent;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      transform: scale(0);
      transition: transform 0.3s ease-in-out;
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

    .fa-icon {
      margin-right: 10px;
      transition: color 0.3s, transform 0.3s;
    }

    #sidebar a:hover .fa-icon,
    #sidebar button:hover .fa-icon {
      color: #FFD700;
      transform: scale(1.2);
    }
  </style>
</head>
<body>
  <div id="sidebar">
    <a href="javascript:void(0);" onclick="loadPage('dashboard.php')">
      <i class="fas fa-home"></i>
      <span>Dashboard</span>
    </a>
    <a href="javascript:void(0);" onclick="loadPage('admission.php')">
      <i class="fas fa-user-plus"></i>
      <span>Admission</span>
    </a>
    <a href="javascript:void(0);" onclick="loadPage('roomm.php')">
      <i class="fas fa-bed"></i>
      <span>Room Management</span>
    </a>
    <a href="javascript:void(0);" onclick="loadPage('fee_collection.php')">
      <i class="fas fa-dollar-sign"></i>
      <span>Fee Collection</span>
    </a>
    <a href="javascript:void(0);" onclick="loadPage('concern.php')">
      <i class="fas fa-exclamation-circle"></i>
      <span>Tenants Concern</span>
    </a>

    <button onclick="logOut()">
      <i class="fas fa-sign-out-alt"></i>
      <span>Log Out</span>
    </button>

    <div id="clickEffect"></div>
  </div>

  <div id="content">
    <iframe id="contentFrame" src="dashboard.php"></iframe>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
  <script>
    function loadPage(page) {
      document.getElementById('contentFrame').src = page;
      showClickEffect(event);
    }

    function logOut() {
      window.location.href = 'index.php';
      showClickEffect(event);
    }

    function showClickEffect(event) {
      const clickEffect = document.getElementById('clickEffect');
      clickEffect.style.left = `${event.clientX - 25}px`;
      clickEffect.style.top = `${event.clientY - 25}px`;
      clickEffect.style.transform = 'scale(1)';
      setTimeout(() => {
        clickEffect.style.transform = 'scale(0)';
      }, 300);
    }
  </script>
</body>

</html>