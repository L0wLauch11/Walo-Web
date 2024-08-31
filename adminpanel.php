<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/adminpanel.css">
    <title>Walo Admin Panel</title>
</head>

<?php

$credentials = parse_ini_file("assets/secrets/credentials.ini");

$user = $_POST['user'];
$pass = $_POST['pass'];

if ($user != $credentials['adminpanel_username'] || $pass != $credentials['adminpanel_password']) {
    if (isset($_POST)) { ?>
        <div class="container adminpanel-login">
            <h1>Walo Admin Panel Login</h1>
            <form method="POST" action="adminpanel.php">
                <p>Username <input class="input" type="text" name="user"></p>
                <p>Password <input class="input" type="password" name="pass"></p>
                <p><input class="button" type="submit" name="submit" value="Login"></p>
            </form>
        </div>
    <?php }

    return;
}

?>

<body>
    <main class="container adminpanel-container">
        <h1 style="font-weight: bold;">Walo Admin Panel</h1>
        <p>Hier kannst du die Datenbank manipulieren.</p>

        <form class="adminpanel-manipulation" method="GET" action="database.php">
            <p>
                <b>Operation</b>
                <select onchange='this.form.submit()' name="operation" class="dropdown">
                    <?php

                    $actions = ['inittable', 'createplayer', 'getkills', 'addkill', 'addwin', 'addplaycount', 'removeplaycount', 'removewin', 'removekill'];
                    foreach ($actions as $action) {
                        echo "<option value='$action'>$action</option>";
                    }

                    ?>
                </select>
            </p>

            <!-- DO NOT SHARE THIS WITH ANYONE YOU DON'T TRUST -->
            <input type="hidden" name="secret" value="<?= file_get_contents("assets/secrets/database_access_security_string.txt") ?>">

            <p><b>Minecraft UUID</b> (not required for 'inittable') <input class="input" type="text" value="" name="uuid"></p>
            <p><b>Minecraft Username</b> (not required for 'inittable') <input class="input" type="text" value="" name="name"></p>
            <p><b>Value</b> (always optional) <input class="input" type="text" value="" name="value"></p>
            <p><input class="button" type="submit" name="submit" value="Execute"></p>
        </form>
    </main>
</body>

</html>