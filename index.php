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
    <link rel="stylesheet" href="css/mc-server-widget.css">
    <title><?= Env::WEBSITE_NAME; ?></title>
</head>

<body>
    <header>
        <?php include "$root/navigation/navigation.php"; ?>
    </header>

    <div class="background"></div>

    <div class="container">
        <div class="brief">
            <h1>Minecraft-Walo</h1>

            <?php if (Env::USE_MINECRAFT_SERVER_STATUS_API): ?>
                <?php
                function getMcServerStatusJson($mcServerStatusCacheFile) {
                    $mcServerStatusJson = Util::curl('https://api.mcsrvstat.us/3/'.Env::MC_SERVER_ADDRESS);
                    $mcServerStatus = json_decode($mcServerStatusJson, true);

                    file_put_contents($mcServerStatusCacheFile, $mcServerStatusJson);

                    return $mcServerStatus;
                }

                $mcServerStatusCache = "$root/mc-server-status-cache/".Env::MC_SERVER_ADDRESS;

                if (file_exists($mcServerStatusCache)) {
                    $fiveMinutes = 300;

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
                        <button id="server-address" onclick="copyServerAddress()">
                            <span class="widescreen-only tooltip">
                                <span class="tooltip-unclicked">Klicke&nbsp;zum&nbsp;kopieren!</span>
                                <span class="tooltip-clicked">Kopiert!</span>
                            </span>

                            <div class="server-favicon-container">
                                <img src="{$mcServerStatus['icon']}" alt="Server Favicon">
                            </div>

                            <div class="server-description-container">
                                <span style="font-size: 18px;" id="server-address-text">{$mcServerStatus['hostname']}</span>
                                <img src="assets/icon/icon-copy.png" style="width: 16px;" alt="Copy Icon">
                                <span class="server-online-counter">{$mcServerStatus['players']['online']} / {$mcServerStatus['players']['max']}</span>

                                <div class="server-motd">
                                    {$motd}
                                </div>
                            </div>
                        </button>
                    HTML;
                } else {
                    $serverAddress = Env::MC_SERVER_ADDRESS;

                    print <<<HTML
                        <button id="server-address" onclick="copyServerAddress()">
                            <span id="server-address-text">{$serverAddress}</span> ist <span style="color: red;">offline</span>!
                            <img src="assets/icon/icon-copy.png" alt="copy" style="width: 16px;">
                        </button>
                    HTML;
                }
                ?>
            <?php else: ?>
                <button id="server-address" onclick="copyServerAddress(this)">
                    <span id="server-address-text"><span style="color: var(--color-text);">Minecraft Serveradresse:</span> <?= Env::MC_SERVER_ADDRESS; ?></span>
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

                <?php if (Env::DISCORD_INVITE != null): ?>
                    <li>
                        <img src="/assets/icon/calendar.png" alt="calendar">
                        <b>Termine</b>: auf <a style="color: mediumslateblue; font-weight: bold;" target="_blank" href="<?= Env::DISCORD_INVITE; ?>">Discord</a>
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

    <span type="text" id="server-address-input" style="display: none;"><?= Env::MC_SERVER_ADDRESS; ?></span>
    <script src="js/mc-server-widget.js" defer></script>

    <?php include 'footer.php'; ?>
</body>

</html>