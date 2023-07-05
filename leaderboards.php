<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel="shortcut icon" type="assets/walo-small.png" href="favicon.ico" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/leaderboards.css">
    <title>Walo</title>
</head>

<body>
    <header>
        <?php
        $root = $_SERVER["DOCUMENT_ROOT"];
        include "$root/navigation.html";
        ?>
    </header>

    <?php
    $sort = "WINS";

    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
    }
    ?>

    <p id="heading">Leaderboards</p>

    <div class="container">
        <form action="leaderboards.php">
            <div class="sort-by-selector">
                <label for="sort-by">Sortieren nach:&nbsp;&nbsp;</label>
                <select onchange='this.form.submit()' name="sort" id="sort-by">
                    <option value="WINS" <?php if ($sort == "WINS") {echo 'selected';} ?>>Wins</option>
                    <option value="KILLS"<?php if ($sort == "KILLS") {echo 'selected';} ?>>Kills</option>
                    <option value="PLAYCOUNT" <?php if ($sort == "PLAYCOUNT") {echo 'selected';} ?>>Plays</option>
                </select> ▼
                <br><br>
            </div>
        </form>
        <br>
        <div class="hr"></div>

        <?php

        function create_leaderboard($conn, $sort)
        {
            // Sort DB by wanted statistic
            $sql = "ALTER TABLE walo ORDER BY $sort DESC";
            $conn->query($sql);

            // Fetch leaderboards from DB
            $sql = "SELECT * FROM walo";
            $result = $conn->query($sql);
            $entries = false;

            // If entries exist
            if ($result->num_rows > 0) {
                echo "<table cellspacing='0' cellpadding='0' id='rankings'>";

                echo "<tr class='leaderboard-row'>";
                echo "<th class='leaderboard-column'>Name</th>";
                echo "<th class='leaderboard-column'>Wins</th>";
                echo "<th class='leaderboard-column'>Kills</th>";
                echo "<th class='leaderboard-column'>Plays</th>";
                echo "</tr>";

                $i = 0;
                while ($row = mysqli_fetch_array($result)) {
                    $darker = "";
                    $placement = "";

                    if ($i % 2 == 0) {
                        $darker = "class='row-darker'";
                    }

                    if ($i == 0) {
                        $placement = "id='first-place'";
                    } else if ($i == 1) {
                        $placement = "id='second-place'";
                    } else if ($i == 2) {
                        $placement = "id='third-place'";
                    }

                    $i++;

                    $name = $row['NAME'];
                    $wins = $row['WINS'];
                    $kills = $row['KILLS'];
                    $playcount = $row['PLAYCOUNT'];
                    
                    if ($wins + $kills + $playcount == 0) {
                        continue;
                    }

                    echo "<tr $darker>";
                    echo "<td $placement class='leaderboard-stat leftmost'>$name</td>";
                    echo "<td $placement class='leaderboard-stat center'>$wins</td>";
                    echo "<td $placement class='leaderboard-stat center'>$kills</td>";
                    echo "<td $placement class='leaderboard-stat rightmost'>$playcount</td>";
                    echo "</tr>";
                }
                echo "</table>";

                $entries = true;
            }

            // No entries
            if ($entries == false) {
                echo "<p id='no-data'>Noch keine Einträge</p><br>";
            }
        }

        ?>

        <?php

        $ini_array = parse_ini_file("assets/secrets/credentials.ini");

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
        
        if (isset($_GET['sort'])) {
            create_leaderboard($conn, $_GET['sort']);
        } else {
            create_leaderboard($conn, "WINS");
        }
        

        $conn->close();
        ?>
    </div>
</body>

</html>