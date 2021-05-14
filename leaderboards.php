<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="shortcut icon" type="assets/walo-small.png" href="favicon.ico" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/master.css">
    <title>Walo</title>
    <input type="text" value="walo.ga" id="server-address-input">
  </head>

  <body>

  <header>
        <nav>
            <ul>
            <li><h1>Walo</h1></li>
            <li><a href="index.html">Home</a></li>
            <li><a href="leaderboards.php">Leaderboards</a></li>
            <li><a target="_blank" href="https://discord.gg/3ZHhqeUG">Discord</a></li>
            <li><a target="_blank" href="https://github.com/L0wLauch11">GitHub</a></li>
            </ul>
        </nav>
    </header>

    <p id="next-walo">Leaderboards</p>

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
              while($row = $result->fetch_assoc()) {
                  if ($row["KILLS"] > 0) {
                      echo "<div class='row'><div class='name'>" . $row["NAME"] . "</div><div class='score'>" . $row["KILLS"] . "</div><div class='kills-text'>Kills</div></div>";
                      
                      $entries = true;
                  }
              }
              echo "</div>";
        }
        
        if($entries == false) {
            echo "<p id='no-data'>Noch keine Einträge</p>";
        }

        $conn->close();
      ?>


    </div>
  </body>
</html>
