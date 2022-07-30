<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel="shortcut icon" type="assets/walo-small.png" href="favicon.ico" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/master.css">
    <title>Walo</title>
</head>

<body>
    <header>
        <?php
        $root = $_SERVER["DOCUMENT_ROOT"];
        include "$root/navigation.html";
        ?>
    </header>

    <p id="heading">Leaderboards</p>

    <div class="container">
        <h1>Kills:</h1>

        <?php
        $ini_array = parse_ini_file("assets/credentials.ini");

        $servername = $ini_array['servername'];
        $username = $ini_array['username'];
        $password = $ini_array['password'];
        $dbname = $ini_array['dbname'];

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM walo";
        $result = $conn->query($sql);
        $num = 0;
        $entries = false;

        if ($result->num_rows > 0) {
            // generate kill leaderboard

            echo "<div id='rankings'>";
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $div_darker = "";
                $div_darker_end = "";

                if ($i % 2 == 0) {
                    $div_darker = "<div class='leaderboard-darker'>";
                    $div_darker_end = "</div>";
                }
                $i++;

                if ($row["KILLS"] > 0) {
                    $name = $row['NAME'];
                    $kills = $row['KILLS'];

                    echo "<div class='row'>$div_darker<div class='name'>$name</div><div class='score'>$kills</div><div class='kills-text'>Kills</div>$div_darker_end</div>";

                    $entries = true;
                }
            }
            echo "</div>";
        }

        if ($entries == false) {
            echo "<p id='no-data'>Noch keine Einträge</p>";
        }

        $conn->close();
        ?>


    </div>
</body>

</html>