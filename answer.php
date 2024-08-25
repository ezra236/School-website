<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="refresh" content="320">
    <link rel="icon" href="weather.png" type="image/png">
    <title>News</title>
    <style>
        body {
            background-color: #153141;
            font-family: Arial, sans-serif;
        }
        nav {
            background-color: green;
            padding: 10px 0;
            text-align: center;
        }
        nav a {
            text-decoration: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-right: 20px;
        }
        nav a:hover {
            background-color: blue;
        }
        nav a[href="news.php"] {
            color: black;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        .form-container {
            background-color: black;
            padding: 70px;
            margin: 20px auto;
            color: white;
            text-align:left;
            width: 50%;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 700px; /* Set a maximum width for content clarity */
            min-height: 20vh; /* Minimum full viewport height */
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .form-container h2 {
            text-align:center;
            color: green;
        }
        .form-container form {
            text-align:left;
        }
        .form-container button {
            background-color: green;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        .form-container button:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>
    <nav>
        <a href="index.html">Home</a>
        <a href="Dashboard.html">Dashboard</a>
        <a href="news.html">News</a>
        <a href="feedback.html">Feedback</a>
    </nav>

    <section id="news">
        <div class="form-container">
            <h2>News</h2>
            <div id="news-message">
                <?php
                    $con = new mysqli("localhost", "root", "", "admin");

                    if ($con->connect_error) {
                        die("Connection failed: " . $con->connect_error);
                    }

                    $sql = "SELECT * FROM news";
                    $result = $con->query($sql);

                    if ($result->num_rows > 0) {
                        while ($data = $result->fetch_assoc()) {
                            echo "ATTENTION: " . $data['content'] . "<br>";
                        }
                    } else {
                        echo "No news available.";
                    }

                    $con->close();
                ?>
            </div>
        </div>
    </section>
</body>
</html>
