<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Walo Dokumentation</title>
    <link rel="stylesheet" href="../css/master.css">
    <link rel="stylesheet" href="../css/documentation.css">
</head>
<body>
    <header>
        <?php
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);

        $root = $_SERVER['DOCUMENT_ROOT'];
        include "$root/navigation.html";

        $articlesFolder = $_SERVER['DOCUMENT_ROOT'].'/documentation/articles';
        ?>
    </header>

    <div class="documentation-side-nav">
        <ul>
            <?php
            $articles = ['Self-Hosting.php', 'Konfiguration.php'];
            ?>

            <?php foreach ($articles as $article) { ?>
                <li>
                    <a href="<?= '/documentation/?article='.$article; ?>">
                        <?= ucfirst(
                                str_replace('.php', '', 
                                str_replace('-', ' ', 
                                    $article
                                )
                                )
                            ); ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>

    <main class="documentation-content">
        <?php 
        if (isset($_GET['article'])) {
            include $articlesFolder.'/'.$_GET['article'];
        }
        ?>
    </main>
</body>
</html>