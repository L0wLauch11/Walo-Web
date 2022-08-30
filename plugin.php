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

    <p id="heading">Walo Minecraft-Plugin</p>

    <div class="container">
        <p id="info-text">Neuste Version:</p>
        <div class="info">
            <ul>
                <?php

                $files = glob('walo-plugin/*.jar');
                usort($files, function($a, $b) {
                    return filemtime($b) - filemtime($a);
                });
                
                $counter = 0;
                foreach($files as $file) {
                    if($counter == 1) {
                        print '<p id="info-text">Ältere Versionen:</p>';
                    }

                    $filename = basename($file);
                    print "<li><a href='walo-plugin/$filename'><img src='assets/plugin-source.png' alt=''>$filename</a>";

                    if (file_exists("walo-plugin/$filename.html"))
                        include "walo-plugin/$filename.html";

                    print "</li>";

                    $counter++;
                }

                ?>
            </ul>
        </div>
                
        <p id="web-source">Plugin Quellcode: <a
                href="https://github.com/L0wLauch11/Walo">https://github.com/L0wLauch11/Walo</a></p>
    </div>

</body>

</html>