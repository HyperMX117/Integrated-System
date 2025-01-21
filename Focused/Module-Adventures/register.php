<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xtreme Adventure Tours</title>
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lapis:wght@400&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Lato', 'Lapis', Helvetica, Arial, Lucida, sans-serif;
        }

        body {
            background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2));
            background-position: calc();
            background-size: cover;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: black;
        }

        .signup {
            font-family: 'Lato', 'Lapis', Helvetica, Arial, Lucida, sans-serif;
            max-width: 500px;
            width: 100%;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 10px;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: auto;
            text-align: center;
            color: black;
            display: flex;
            justify-content: center;
            flex-direction: column;
            gap: 10px;
        }

        form {
            padding: 20px 0;
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        input {
            width: 100%;
            outline: none;
            padding: 5px;
            border: 1px solid black;
        }

        label {
            max-width: 120px;
            width: 100%;
            text-align: left;
            padding-top: 10px;
        }

        .verify {
            display: flex;
            gap: 10px;
            padding: 10px 0;
        }

        .verify input {
            width: 15px;
        }

        .verify label {
            padding: 0;
        }

        button {
            padding: 5px;
            background-color: transparent;
            border: 1px solid white;
            color: white;
            transition: all 300ms;
        }

        button:hover {
            background-color: white;
            color: black;
        }
    </style>
</head>

<body style="background-image: url('images/back2.jpg')">
    <div class="signup">
        <h2>Signup</h2>
        <form action="signup.php" method="post">
            <label for="fname">First Name</label>
            <input type="text" name="fname" id="fname" required>

            <label for="lname">Last Name</label>
            <input type="text" name="lname" id="lname" required>

            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>

            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required><br>

            <button type="submit">Sign Up</button>
        </form>
    </div>
</body>

</html>