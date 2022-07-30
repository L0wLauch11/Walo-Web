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

    <p id="heading">Nächster Walo Termin: Unbekannt</p>

    <div class="container">
        <h1>Minecraft-Walo</h1>
        <button id="server-address" onclick="copyServerAddress()">
            Server-Adresse: <span id="server-address-text">mc.walo.gay</span>
            <img src="assets/icon-copy.png" alt="copy" style="width: 16px;">
        </button>
        <p>Walo ist eine eigene Version des beliebten Minecraft Projekts Varo.</p>

        <div class="info">
            <ul>
                <p id="info-text">Wichtige Informationen</p>

                <li>
                    <img src="assets/mc-logo-minimal.png" alt="mc-logo">
                    <b>Minecraft Version</b>: 1.8
                </li>

                <li>
                    <img src="assets/clock.png" alt="clock">
                    <b>Spieldauer</b>: ~3h
                </li>

                <li>
                    <img src="assets/team.png" alt="people">
                    <b>Teamgröße</b>: 2 - 4
                </li>

                <li>
                    <img src="assets/sword.png" alt="sword">
                    <b>Combat-Logging</b>: man wird automatisch gebannt
                </li>

                <li>
                    <img src="assets/calendar.png" alt="calendar">
                    <b>Termine</b>: zuerst auf Discord
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

        <p id="info-text">Commands</p>

        <div class="info">
            <ul>
                <li><b>/walo stats [Spieler]</b> - Zeigt die Statistiken eines Spielers an</li>
                <li><b>/walo scoreboard</b> - Deaktiviert bzw. aktiviert das Scoreboard</li>
            </ul>
        </div>

        <p id="web-source">Website Quellcode: <a
                href="https://github.com/L0wLauch11/Walo-Web">https://github.com/L0wLauch11/Walo-Web</a></p>

    </div>

    <input type="text" value="walo.ga" id="server-address-input" style="opacity: 0%;">

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
</body>

</html>