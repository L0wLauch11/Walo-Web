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
        
        include_once 'DocumentationUtil.class.php';
        include_once 'Heading.class.php';

        $articlesFolder = $_SERVER['DOCUMENT_ROOT'].'/documentation/articles';
        ?>
    </header>

    <div class="documentation-side-nav">
        <ul>
            <?php
            $articles = ['Self-Hosting.php', 'Konfiguration.php'];
            ?>

            <?php foreach ($articles as $article) { ?>
                <div class="header-counter-reset"></div>
                <li>
                    <a href="<?= "/documentation/?article=$article"; ?>">
                        <?php
                        // related - https://stackoverflow.com/questions/14648442/domdocumentloadhtml-warning-htmlparseentityref-no-name-in-entity
                        libxml_use_internal_errors(true);
                        
                        $renderedHtml = DocumentationUtil::renderPhp("$articlesFolder/$article");
                        $dom = new DOMDocument();
                        $dom->loadHTML(
                            // Encoding somehow being parsed incorrectly by this function
                            mb_convert_encoding($renderedHtml, 'ISO-8859-1', 'UTF-8')
                        );

                        $masterHeading = $dom->getElementsByTagName('h1')->item(0);
                        ?>

                        <?= $masterHeading->nodeValue; ?>
                    </a>

                    <?php
                    $xpath = new DOMXPath($dom);
                    $subHeadings = $xpath->query('//h2 | //h3 | //h4');
                    ?>
                    <?php foreach($subHeadings as $subHeading): ?>
                        <a 
                            class="side-nav-subheading side-nav-subheading-<?= $subHeading->tagName; ?>"
                            href="<?= "/documentation/?article=$article#{$subHeading->id}"; ?>"
                        >
                            <?= $subHeading->nodeValue; ?>
                        </a>
                    <?php endforeach; ?>
                </li>
            <?php } ?>
        </ul>
    </div>

    <main class="documentation-content">
        <?php
        if (isset($_GET['article'])) {
            // Security Risk: would otherwise allow stealing credentials!
            // e. g. "?article=../../assets/secrets/credentials.ini" would actually output the credentials.ini file!
            if (str_contains($_GET['article'], '..')) {
                include $articlesFolder.'/'.$articles[0];
            }

            include $articlesFolder.'/'.$_GET['article'];
        } else {
            include $articlesFolder.'/'.$articles[0];
        }
        ?>
    </main>
</body>
</html>