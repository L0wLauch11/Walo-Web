<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include "$root/env.php";
?>

<head>
    <link rel="shortcut icon" type="assets/walo-small.png" href="favicon.ico" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/leaderboards.css">
    <title><?= Env::WEBSITE_NAME; ?> Leaderboards</title>
</head>

<body>
    <header>
        <?php include "$root/navigation/navigation.php"; ?>
    </header>

    <?php
    $sort = "WINS";

    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
    }
    ?>

    <div class="background"></div>

    <div class="container">
        <form action="leaderboards.php">
            <div class="sort-by-selector">
                <label for="sort-by">Sortieren nach:&nbsp;&nbsp;</label>
                <select onchange='this.form.submit()' name="sort" id="sort-by">
                    <option value="WINS" <?= $sort == "WINS" ? 'selected' : ''; ?>>Wins</option>
                    <option value="KILLS" <?= $sort == "KILLS" ? 'selected' : ''; ?>>Kills</option>
                    <option value="PLAYCOUNT" <?= $sort == "PLAYCOUNT" ? 'selected' : ''; ?>>Plays</option>
                </select>
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
            $sql = "SELECT * FROM walo LIMIT 100";
            $result = $conn->query($sql);

            // If entries exist
            if ($result->num_rows > 0) {
                echo <<<HTML
                    <table cellspacing='0' cellpadding='0' id='rankings'>
                        <tr class='leaderboard-row'>
                        <th class='leaderboard-column'>Name</th>
                        <th class='leaderboard-column'>Wins</th>
                        <th class='leaderboard-column'>Kills</th>
                        <th class='leaderboard-column'>Plays</th>
                    </tr>
                HTML;

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

                    $name = $row['NAME'];
                    $wins = $row['WINS'];
                    $kills = $row['KILLS'];
                    $playcount = $row['PLAYCOUNT'];
                    
                    if ($wins + $kills + $playcount == 0) {
                        continue;
                    }

                    echo "
                        <tr $darker>
                            <td $placement class='leaderboard-stat leftmost'>$name</td>
                            <td $placement class='leaderboard-stat center'>$wins</td>
                            <td $placement class='leaderboard-stat center'>$kills</td>
                            <td $placement class='leaderboard-stat rightmost'>$playcount</td>
                        </tr>
                    ";

                    $i++;
                }
                echo "</table>";
            } else {
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

    <?php include 'footer.php' ?>
</body>

</html>