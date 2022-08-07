<?php
$minecraft_uuid = $_GET['uuid'];
$minecraft_name = $_GET['name'];
$security_string = $_GET['secret'];
$operation = $_GET['operation'];

if (!isset($minecraft_uuid) || !isset($minecraft_name) || !isset($security_string) || !isset($operation)) {
    echo 'Please make sure you input a minecraft player uuid the security string and an operation';
    return;
}

if ($security_string != file_get_contents('assets/secrets/database_access_security_string.txt')) {
    echo 'Wrong security string';
    return;
}

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


$sql = '';
switch ($operation) {
    case 'inittable':
        $sql = 'CREATE TABLE IF NOT EXISTS walo (UUID VARCHAR(100), NAME VARCHAR(100), KILLS INT(100))';
        $conn->query($sql);

        echo 'Walo table created';

        break;

    case 'createplayer':
        $sql_get_kills = "SELECT * FROM walo WHERE UUID='$minecraft_uuid'";

        $result = $conn->query($sql_get_kills);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $kills = $row['KILLS'];
            }
        }

        if (!isset($kills)) {
            $sql = "INSERT INTO walo (UUID, NAME, KILLS) VALUES ('$minecraft_uuid', '$minecraft_name', 0)";
            $result = $conn->query($sql);
        }

        echo 'Player created successfully';
        
        break;

    case 'addkill':
        $kills = 0;
        $sql_get_kills = "SELECT * FROM walo WHERE UUID='$minecraft_uuid'";

        $result = $conn->query($sql_get_kills);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $kills = $row['KILLS'];
            }
        }

        $new_kills = $kills + 1;
        $sql = "UPDATE walo SET KILLS=$new_kills WHERE UUID='$minecraft_uuid'";
        $conn->query($sql);

        echo 'Kill added successfully';

        break;
    
    case 'getkills':
        $kills = 0;
        $sql_get_kills = "SELECT * FROM walo WHERE UUID='$minecraft_uuid'";

        $result = $conn->query($sql_get_kills);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $kills = $row['KILLS'];
            }
        }

        echo $kills;

        break;

        case 'addwin':
            $kills = 0;
            $sql_get_kills = "SELECT * FROM walo WHERE UUID='$minecraft_uuid'";
    
            $result = $conn->query($sql_get_kills);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $wins = $row['WINS'];
                }
            }
    
            $new_wins = $wins + 1;
            $sql = "UPDATE walo SET WINS=$new_wins WHERE UUID='$minecraft_uuid'";
            $conn->query($sql);

            echo 'Win added successfully';

            break;

    default:
        echo 'Not a valid operation';
    
        break;
}

if ($sql == '') {
    return;
}

$conn->close();
?>