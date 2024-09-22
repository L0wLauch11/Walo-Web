<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include "$root/env.php";
include "$root/Util.class.php";
?>

<head>
    <link rel="shortcut icon" type="assets/walo-small.png" href="favicon.ico" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/master.css">
    <title><?= Env::$website_name; ?></title>
</head>

<body>
    <header>
        <?php include "$root/navigation/navigation.php"; ?>
    </header>

    <div class="background"></div>

    <div class="container">
        <div class="brief">
            <h1>Minecraft-Walo</h1>

            <?php if (Env::$use_minecraft_server_status_api): ?>
                <?php
                function getMcServerStatusJson($mcServerStatusCacheFile) {
                    $mcServerStatusJson = Util::curl('https://api.mcsrvstat.us/3/'.Env::$mc_server_address);
                    $mcServerStatus = json_decode($mcServerStatusJson, true);

                    file_put_contents($mcServerStatusCacheFile, $mcServerStatusJson);

                    return $mcServerStatus;
                }

                $mcServerStatusCache = "$root/mc-server-status-cache/".Env::$mc_server_address;

                if (file_exists($mcServerStatusCache)) {
                    $fiveMinutes = 300000;
                    if (time() - filemtime($mcServerStatusCache) > $fiveMinutes) {
                        $mcServerStatus = getMcServerStatusJson($mcServerStatusCache);
                    }

                    $mcServerStatus = json_decode(file_get_contents($mcServerStatusCache), true);
                } else {
                    $mcServerStatus = getMcServerStatusJson($mcServerStatusCache);
                }

                if ($mcServerStatus['online']) {
                    $motd = "";
                    foreach ($mcServerStatus['motd']['html'] as $motdLine) {
                        $motd .= <<<HTML
                            <div style="font-size: 15px;">
                                {$motdLine}
                            </div>
                        HTML;
                    }

                    print <<<HTML
                        <button style="font-size: 18px; padding-bottom: 4px;" id="server-address" onclick="copyServerAddress()">
                            <div style="margin-right: 8px; float:left; display: inline-block; vertical-align: top;">
                                <img style="display: inline-block;" src="{$mcServerStatus['icon']}" alt="">
                            </div>

                            <div style="text-align: left; width: fit-content;">
                                <span style="font-size: 18px;" id="server-address-text">{$mcServerStatus['hostname']}</span>
                                <img src="assets/icon/icon-copy.png" alt="copy" style="width: 16px;">
                                <span style="float: right; margin-right: 4px;">{$mcServerStatus['players']['online']} / {$mcServerStatus['players']['max']}</span>

                                <div style="display: inline-block; font-family: monospace; height: fit-content;">
                                    <span style="inline-block;">{$motd}</span>
                                </div>    
                            </div>
                        </button>
                    HTML;
                } else {
                    print <<<HTML
                        <button id="server-address" onclick="copyServerAddress()">
                            <span id="server-address-text">{Env::$mc_server_address} ist offline!</span>
                            <img src="assets/icon/icon-copy.png" alt="copy" style="width: 16px;">
                        </button>
                    HTML;
                }
                ?>
            <?php else: ?>
                <button id="server-address" onclick="copyServerAddress()">
                    <span id="server-address-text"><?= Env::$mc_server_address; ?></span>
                    <img src="assets/icon/icon-copy.png" alt="copy" style="width: 16px;">
                </button>
            <?php endif; ?>

            <p>In Walo bildest du Teams und beweist dich gegen Andere im PVP-Kampf.</p>
        </div>

        <div class="spacer-big"></div>
        <div class="seperator"></div>

        <div class="info">
            <ul>
                <p class="info-text">Informationen</p>
                <div class="spacer"></div>

                <li>
                    <img src="assets/icon/mc-logo-minimal.png" alt="mc-logo">
                    <b>Minecraft Version</b>: 1.8
                </li>

                <li>
                    <img src="assets/icon/clock.png" alt="clock">
                    <b>Spieldauer</b>: zirka 3 Stunden
                </li>

                <?php if (Env::$discord_invite != null): ?>
                    <li>
                        <img src="/assets/icon/calendar.png" alt="calendar">
                        <b>Termine</b>: auf <a style="color: mediumslateblue; font-weight: bold;" target="_blank" href="<?= Env::$discord_invite; ?>">Discord</a>
                    </li>
                <?php endif; ?>

                <li>
                    <img src="assets/icon/team.png" alt="people">
                    <b>Spieler</b>: bis zu 50
                </li>

                <!-- Is this really important to know on the homepage?
                    <li>
                        <img src="assets/icon/sword.png" alt="sword">
                        <b>Combat-Logging</b>: man wird automatisch gebannt
                    </li> 
                -->
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
                <img src="assets/screenshot/screenshot-info.png" alt="">
                <p>Vor dem Spielstart werden die wichtigsten Informationen im Chat angezeigt</p>
            </div>

            <div class="info-container">
                <p>Während des Spiels werden am Scoreboard Infos angezeigt</p>
                <img src="assets/screenshot/screenshot-scoreboard.png" alt="">
            </div>

            <div class="info-container">
                <img src="assets/screenshot/screenshot-mine.png" alt="">
                <p>Das Ziel des Spiels ist es gute Sachen zu farmen...</p>
            </div>

            <div class="info-container" id="last-info-screenshot">
                <p>... und am Ende alle auszuschalten</p>
                <img src="assets/screenshot/screenshot-armor.png" alt="">
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

    <span type="text" id="server-address-input" style="display: none;"><?= Env::$mc_server_address; ?></span>

    <script type="text/javascript">
        function copyServerAddress() {
            let copyText = document.getElementById("server-address-input");
            navigator.clipboard.writeText(copyText.textContent);
        }
    </script>

    <?php include 'footer.php'; ?>
</body>

</html>