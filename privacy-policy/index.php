<!DOCTYPE html>
<html lang="en">

<?php
$root = $_SERVER['DOCUMENT_ROOT'];

include "$root/env.php";
include "$root/Util.class.php";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/master.css">
    <link rel="stylesheet" href="/css/privacy-policy.css">
    <title><?= Env::WEBSITE_NAME; ?> Privacy Policy</title>
</head>

<body>
    <header>
        <?php include "$root/navigation/navigation.php";?>
    </header>

    <div class="background"></div>

    <main class="container privacy-policy-container">
        <?php
        include_once 'parsedown-1.7.4/Parsedown.php';
        print (new Parsedown())->text(Util::renderPhp('privacy-policy.md.php'));
        ?>
    </main>

    <?php include "$root/footer.php" ?>
</body>
</html>