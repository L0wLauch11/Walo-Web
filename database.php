<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$credentials = parse_ini_file("assets/secrets/credentials.ini");

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
    echo 'uuid, name, secret or operation is missing';
    return;
}

if ($security_string != file_get_contents('assets/secrets/database_token.txt')) {
    echo 'Wrong database token';
    return;
}

$servername = $credentials['servername'];
$username = $credentials['username'];
$password = $credentials['password'];
$dbname = $credentials['dbname'];

// Create connection
$conn = new mysqli($servername, $username, $password);
$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
mysqli_select_db($conn, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$value = 1;
if (isset($_GET['value'])) {
    $value = $_GET['value'];
}

switch ($operation) {
    case 'inittable':
        $sql = 'CREATE TABLE IF NOT EXISTS walo (UUID VARCHAR(100), NAME VARCHAR(100), KILLS INT(100), WINS INT(100), PLAYCOUNT INT(100))';
        $conn->query($sql);

        echo 'Walo database and/or table created';

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
            $sql = "INSERT INTO walo (UUID, NAME, KILLS, WINS, PLAYCOUNT) VALUES ('$minecraft_uuid', '$minecraft_name', 0, 0, 0)";
            $result = $conn->query($sql);
        }

        echo 'Player created successfully';
        
        break;

    case 'getkills':
        echo get_value($conn, $minecraft_uuid, "KILLS");

        break;

    case 'addkill':
        add_value($conn, $minecraft_uuid, "KILLS", $value);

    break;

    case 'addwin':
        add_value($conn, $minecraft_uuid, "WINS", $value);

        break;

    case 'addplaycount':
        add_value($conn, $minecraft_uuid, "PLAYCOUNT", $value);

        break;

    case 'removeplaycount':
        add_value($conn, $minecraft_uuid, "PLAYCOUNT", -$value);

        break;

    case 'removewin':
        add_value($conn, $minecraft_uuid, "WINS", -$value);

        break;

    case 'removekill':
        add_value($conn, $minecraft_uuid, "KILLS", -$value);

        break;
    

    default:
        echo 'Not a valid operation';
    
        break;
}

$conn->close();
?>