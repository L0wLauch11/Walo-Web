<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/master.css">
    <link rel="stylesheet" href="/css/privacy-policy.css">
    <title>Walo Privacy Policy</title>
</head>
<body>
    <header>
        <?php
        $root = $_SERVER['DOCUMENT_ROOT'];

        include "$root/env.php";
        include "$root/navigation/navigation.php";
        include "$root/Util.class.php";
        ?>
    </header>

    <div class="background"></div>

    <main class="container privacy-policy-container">
        <?php
        include_once 'parsedown-1.7.4/Parsedown.php';

        $parsedown = new Parsedown();
        print $parsedown->text(Util::renderPhp('privacy-policy.md.php'));
        ?>
    </main>

    <?php include "$root/footer.php" ?>
</body>
</html>