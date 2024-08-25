<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Change Password</title>
    <style>
        body {
            background-color: #153141;
            font-family: Arial, sans-serif;
            color: white;
        }
        .form-container {
            background-color: black;
            padding: 50px;
            margin: 20px auto;
            width: 50%;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 500px;
        }
        .form-container h2 {
            color: green;
        }
        .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 2px solid black;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-container button {
            background-color: green;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-container button:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Change Password</h2>
        <form action="change_password.php" method="POST">
            <label for="new_password">New Password:</label><br>
            <input type="password" id="new_password" name="new_password" required><br><br>
            <button type="submit">Change Password</button>
        </form>
    </div>
</body>
</html>
