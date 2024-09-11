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
        $root = dirname(__FILE__);
        include $_SERVER['DOCUMENT_ROOT'].'/env.php';
        include "$root/navigation/navigation.php";
        
        ?>
    </header>

    <p id="heading">Über das Projekt</p>

    <div class="container">
        <div class="brief">
            <h1>Minecraft-Walo</h1>
            <button id="server-address" onclick="copyServerAddress()">
                Server-Adresse: <span id="server-address-text"><?= Env::$mc_server_address ?></span>
                <img src="assets/icon-copy.png" alt="copy" style="width: 16px;">
            </button>
            <p>In Walo bildest du Teams und beweist dich gegen Andere im PVP-Kampf.</p>
        </div>

        <div class="spacer-big"></div>
        <div class="seperator"></div>

        <div class="info">
            <ul>
                <p class="info-text">Informationen</p>
                <div class="spacer"></div>

                <li>
                    <img src="assets/mc-logo-minimal.png" alt="mc-logo">
                    <b>Minecraft Version</b>: 1.8
                </li>

                <li>
                    <img src="assets/clock.png" alt="clock">
                    <b>Spieldauer</b>: zirka 3 Stunden
                </li>

                <li>
                    <img src="assets/team.png" alt="people">
                    <b>Spieler</b>: bis zu 50
                </li>

                <li>
                    <img src="assets/sword.png" alt="sword">
                    <b>Combat-Logging</b>: man wird automatisch gebannt
                </li>

                <!-- <li>
                    <img src="assets/calendar.png" alt="calendar">
                    <b>Termine</b>: auf Discord
                </li> -->
            </ul>

            <div class="spacer"></div>
            <div class="seperator"></div>

            <ul class="list-forbidden-items">
                <p class="info-text">Verbotene Items</p>
                <div class="spacer-small"></div>

                <p class="subtext">Folgende Items sind verboten und es ist <b>NICHT</b> möglich sie herzustellen:</p>
                <div class="spacer-small"></div>

                <li>
                    <img class="mc-item" src="assets/mc/golden_apple.png" alt="">
                    <span><b>Verzauberter goldener Apfel</b></span>
                </li>

                <li>
                    <img class="mc-item" src="assets/mc/strength_potion.png" alt="">
                    <span><b>Trank der Stärke</b></span>
                </li>
            </ul>

            <div class="info-container">
                <img src="assets/screenshot-info.png" alt="">
                <p>Vor dem Spielstart werden die wichtigsten Informationen im Chat angezeigt</p>
            </div>

            <div class="info-container">
                <p>Während des Spiels werden am Scoreboard Infos angezeigt</p>
                <img src="assets/screenshot-scoreboard.png" alt="">
            </div>

            <div class="info-container">
                <img src="assets/screenshot-mine.png" alt="">
                <p>Das Ziel des Spiels ist es gute Sachen zu farmen...</p>
            </div>

            <div class="info-container" id="last-info-screenshot">
                <p>... und am Ende alle auszuschalten</p>
                <img src="assets/screenshot-armor.png" alt="">
            </div>
        </div>

        <div class="seperator"></div>

        <p class="info-text">Commands</p>

        <div class="info">
            <ul>
                <li><b>/walo stats [Spieler]</b> - Zeigt die Statistiken eines Spielers an</li>
                <li><b>/walo scoreboard</b> - Deaktiviert bzw. aktiviert das Scoreboard</li>
            </ul>
        </div>

        <div class="seperator"></div>

        <p id="web-source">Website Quellcode: <a
                href="https://github.com/L0wLauch11/Walo-Web">https://github.com/L0wLauch11/Walo-Web</a></p>

    </div>

    <input type="text" value="<?= $server_address ?>" id="server-address-input" style="display: none;">

    <script type="text/javascript">
        function copyServerAddress() {
            /* Get the text field */
            var copyText = document.getElementById("server-address-input");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            document.execCommand("copy");
        }
    </script>

    <?php include 'footer.php' ?>
</body>

</html>