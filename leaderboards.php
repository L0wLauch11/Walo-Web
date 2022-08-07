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
        <?php

        function create_leaderboard($conn, $entry, $singular_text, $plural_text)
        {
            $sql = "ALTER TABLE walo ORDER BY $entry DESC";
            $conn->query($sql);

            $sql = "SELECT * FROM walo";
            $result = $conn->query($sql);
            $entries = false;

            echo "<br><button type='button' class='collapsible'>$plural_text</button>";
            if ($result->num_rows > 0) {
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

                    if ($row[$entry] > 0) {
                        $name = $row['NAME'];
                        $wins = $row[$entry];

                        $text = $plural_text;
                        if ($wins == 1) {
                            $text = $singular_text;
                        }

                        echo "<div class='row'>$div_darker<div class='name'>$name</div><div class='score'>$wins</div><div class='kills-text'>$text</div>$div_darker_end</div>";

                        $entries = true;
                    }
                }
                echo "</div><br>";
            }

            if ($entries == false) {
                echo "<p id='no-data'>Noch keine Einträge</p><br>";
            }

            echo '<div class="hr"></div>';
        }

        ?>

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

        echo '<div class="hr"></div>';
        create_leaderboard($conn, "WINS", "Win", "Wins");
        create_leaderboard($conn, "KILLS", "Kill", "Kills");
        create_leaderboard($conn, "PLAYCOUNT", "Play", "Plays");

        $conn->close();
        ?>
    </div>

    <script>
        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.display !== "none") {
                    content.style.display = "none";
                } else {
                    content.style.display = "block";
                }
            });
        }
    </script>
</body>

</html>