<?php

function add_value($conn, $minecraft_uuid, $key, $value_incerement) {
    $value = 0;
    $sql_get_key = "SELECT * FROM walo WHERE UUID='$minecraft_uuid'";

    $result = $conn->query($sql_get_key);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $value = $row[$key];
        }
    }

    $new_value = $value + $value_incerement;
    $sql = "UPDATE walo SET $key=$new_value WHERE UUID='$minecraft_uuid'";
    $conn->query($sql);

    echo "$key is now $new_value";
}

function get_value($conn, $minecraft_uuid, $key) {
    $value = 0;
    $sql_get_value = "SELECT * FROM walo WHERE UUID='$minecraft_uuid'";

    $result = $conn->query($sql_get_value);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $value = $row[$key];
        }
    }

    return $value;
}



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

switch ($operation) {
    case 'inittable':
        $sql = 'CREATE TABLE IF NOT EXISTS walo (UUID VARCHAR(100), NAME VARCHAR(100), KILLS INT(100), WINS INT(100), PLAYCOUNT INT(100))';
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

    case 'getkills':
        echo get_value($conn, $minecraft_uuid, "KILLS");

        break;

    case 'addkill':
        add_value($conn, $minecraft_uuid, "KILLS", 1);

    break;

    case 'addwin':
        add_value($conn, $minecraft_uuid, "WINS", 1);

        break;

    case 'addplaycount':
        add_value($conn, $minecraft_uuid, "PLAYCOUNT", 1);

        break;

    case 'removeplaycount':
        add_value($conn, $minecraft_uuid, "PLAYCOUNT", -1);

        break;

    case 'removewin':
        add_value($conn, $minecraft_uuid, "WINS", -1);

        break;

    case 'removekill':
        add_value($conn, $minecraft_uuid, "KILLS", -1);

        break;
    

    default:
        echo 'Not a valid operation';
    
        break;
}

$conn->close();
?>