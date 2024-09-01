<h1>Self-Hosting</h1>
<p>
Hier erfährst du, wie du deinen eigenen Minecraft-Walo Server inklusive Website und Discord hosten kannst!
</p>

<?= Heading::generate('h2', 'Vorbereitung'); ?>
<p>
Folgende Dinge müssen jedenfalls auf der Host-Maschine installiert sein:
</p>

<ul>
    <li>Java Version 8, zum Beispiel <a href="https://www.azul.com/downloads/#downloads-table-zulu">Azul OpenJDK</a>. Auf den meisten Minecraft-Server Anbietern inklusive.</li>
</ul>

<?= Heading::generate('h2', 'Das vorgemachte Server-Paket verwenden'); ?>
<p>
Am einfachsten ist es, wenn du dir dieses Server-Paket runterladest: <a href="/assets/self-hosting/walo-server-package.zip">walo-server-package.zip</a>. Lasse dieses auf einer Windows oder Linux Maschine laufen und dein Walo-Server ist so gut wie fertig.
</p>

<p>
Es ist ein vorkonfigurierter Server mit ...
</p>

<ul>
    <li><a href="https://papermc.io/">Paper 1.8.8</a> im <a href="https://docs.papermc.io/paper/anti-xray">Anti-XRay Modus 2</a></li>
    <li>dem <a href="/plugin.php">Walo</a>-Plugin</li>
    <li><a href="/assets/self-hosting/WaloRestartCompanion.jar">WaloRestartCompanion</a>, was den Server automatisch neustartet, wenn das Spiel zuende ist</li>
    <li><b>TerrainControl</b> so eingerichtet, dass keine Ozeane mehr generiert werden</li>
    <li><b>DamageIndicator deaktiviert</b> für LabyMod</li>
    <li>einem <b>Spielerlimit von 50</b></li>
</ul>

<?= Heading::generate('h3', 'Server-Paket starten'); ?>
<p>
Nach dem Herunterladen muss man die .zip Datei nurnoch extrahieren, die <span class="code-inline">eula.txt</span> akzeptieren und <span class="code-inline">start.bat</span> (Windows) bzw. <span class="code-inline">start.sh</span> (Unix) ausführen. Am besten du hast einen VPS oder Bare-Metal Server anstelle eines Minecraft-Server anbieters. VPS Anbieter geben dir mehr Kontrolle über dein System, was für manche Features des Walo-Plugins erforderlich sind (Leaderboards, Website, automatischer Restart). 
</p>
<p>
Wie du den Walo-Server, bzw. das Plugin einrichten kannst erfährst du <a href="?article=Konfiguration.php">hier</a>!
</p>

<?= Heading::generate('h2', 'Auf das Server-Paket verzichten'); ?>
<p>
Du vertraust mir nicht und möchtest den Server auf eigene Faust herunterladen? Kein Problem, hier steht wie es geht. Kurz vorweg: <b>Bei der manuellen Einrichtung des Minecraft-Servers wird angenommen, dass du Ubuntu Server 24.04 verwendest.</b> Falls du Windows benutzen willst, lade doch bitte das Server-Paket herunter. Andernfalls bist du hier auf dich alleine gestellt.
</p>

<?= Heading::generate('h3', 'Paper herunterladen'); ?>
<p>
Lade die neuste 1.8.8 Server-Software von <a target="_blank" href="https://papermc.io/downloads/all">papermc.io</a> herunter. Erstelle einen Ordner und kopiere sie unter dem Namen <span class="code-inline">server.jar</span> hinein. Akzeptiere das Minecraft-EULA mit dem Text <span class="code-inline">eula=true</span> in <span class="code-inline">eula.txt</span>.
</p>
<p>
Anschließend erstelle eine Datei namens <span class="code-inline">start.sh</span> mit folgendem Inhalt:
</p>
<pre class="code">
#!/bin/bash
java -Xmx&lt;<b>RAM_GRÖSSE</b>&gt;M -Xms&lt;<b>RAM_GRÖSSE durch 2</b>&gt;M -jar server.jar
</pre>
<p>
Ersetze <span class="code-inline">&lt;RAM_GRÖSSE&gt;</span> mit deiner gewünschten RAM-Größe in <b>Gigabyte</b>. In der Regel lässt man einem Linux-Betriebssystem mindestens 1-2 Gigabyte an Arbeitsspeicher frei, heißt falls du 8GB Arbeitsspeicher hast, kannst du dem Minecraft-Server 6GB zuweisen: (1GB = 1000M)
</p>
<pre class="code">
#!/bin/bash
java -Xmx6000M -Xms3000M -jar server.jar
</pre>

<?= Heading::generate('h3', 'Plugins herunterladen'); ?>
<p>
Folgende Plugins wirst du benötigen:
</p>
<ul>
    <li><a href="/plugin.php">Walo-Plugin</a></li>
    <li><a href="https://github.com/MCTCP/TerrainControl/releases/tag/v2.7.2">TerrainControl v2.7.2</a></li>
</ul>

<p>
Zum deaktivieren des LabyMod DamageIndicators (<b>optional</b>):
</p>
<ul>
    <li><a href="https://www.spigotmc.org/resources/labymod-server-api.52423/">LabyMod Server API</a></li>
    <li><a href="/assets/self-hosting/callable_di_disabler-1.0.jar">callable_di_disabler</a></li>
</ul>
<p>
Verschiebe alle Plugins in den <span class="code-inline">plugins</span> Ordner.
</p>

<?= Heading::generate('h3', 'Konfigurieren'); ?>
<p>
Da du nicht das Server-Paket verwendet hast, sind für dich die <a href="?article=Konfiguration.php#optionaleeinstellungen">Optionalen Konfigurationseinstellungen</a> ganz wichtig zu beachten. Du solltest sie einrichten.
</p>

<?= Heading::generate('h2', 'Optionale Komponente einrichten'); ?>
<p>
Für diesen Teil wirst du Systemzugriff auf deinen Server benötigen, was Minecraft-Server Anbieter in der Regel ausschließt. Ich empfehle einen günstigen <a href="https://en.wikipedia.org/wiki/Virtual_private_server">VPS</a> zu kaufen, wie einer von <a href="https://contabo.com/de/vps/">Contabo</a>. Alternativ kannst du den Server auch bei dir Zuhause beispielsweise auf einem alten Computer ausführen. Falls dies für dich keine Möglichkeit darstellt, kannst du aber trotzdem den Minecraft-Server verwenden, jedoch ohne Leaderboards und automatischen Restarts.
</p>

<?= Heading::generate('h3', 'Website'); ?>
<p>
Dieser Teil setzt voraus, dass du <a href="https://ubuntu.com/download/server">Ubuntu Server</a> 24.04 verwendest. Du kannst auch die Website auf dem selben VPS / Computer laufen lassen, auf dem auch der Minecraft-Server läuft.
</p>

<p>
Installiere <span class="code-inline">git</span>, <span class="code-inline">caddy</span>, <span class="code-inline">php-fpm</span>, <span class="code-inline">php-dom</span> und <span class="code-inline">php-mysql</span> um die Website einrichten zu können:
</p>
<pre class="code">sudo apt install git caddy php-fpm php-dom php-mysql</pre>

<p>
Dann klone folgende Git-Repository und verschiebe sie in <span class="code-inline">/usr/share/caddy/walo-web</span>:
</p>
<pre class="code">
git clone https://github.com/L0wLauch11/Walo-Web.git
sudo mv -f Walo-Web /usr/share/caddy/walo-web
sudo chgrp -R www-data /usr/share/caddy/walo-web/
</pre>
<p>
Beachte, dass du bei jedem Update der Website die Repository nochmal klonen müsstest (also nochmal die oberen Befehle ausführen). Bei einer Aktualisierung der Website, ist auch wichtig, dass das Walo-Plugin auf der neusten Version ist, da sie sonst eventuell nicht mehr gut zusammen spielen können.
</p>

<p>
Kopiere folgendes in die Datei <span class="code-inline">/etc/caddy/Caddyfile</span> (du kannst dies mit <span class="code-inline">sudo nano /etc/caddy/Caddyfile</span> tun):
</p>
<pre class="code">
DEINE_DOMAIN {
    root * /usr/share/caddy/walo-web
    encode zstd gzip
    php_fastcgi unix//run/php/php-fpm.sock
    file_server
}
</pre>
<p>
Ersetze <span class="code-inline">DEINE_DOMAIN</span> mit einer Domain, die du dir Beispielsweise auf <a href="https://freedns.afraid.org/">FreeDNS</a> registriert hast.
</p>
<p>
Und schon kannst du die Website aufrufen unter <span class="code-inline">https://DEINE_DOMAIN/</span>!
</p>

<?= Heading::generate('h4', 'MySQL Datenbank für Leaderboards'); ?>
<p>
Nachdem die Website problemlos läuft, kannst du auch noch die Leaderboards einrichten. Installiere dafür einen MySQL Server mit Adminer. Folgendes Tutorial bringt dir bei, wie du das einrichten kannst: <a href="https://www.makeuseof.com/how-to-install-adminer-on-ubuntu/">https://www.makeuseof.com/how-to-install-adminer-on-ubuntu/</a>.
</p>
<p>
Angenommen du hast erfolgreich einen MySQL Server installiert, kannst du die Datenbank Login-Daten nun mit der Website verknüpfen, sodass Leaderboards gelesen & geändert werden können. Dafür bearbeitest du die Datei <span class="code-inline">assets/secrets/credentials.ini</span> innerhalb des Walo-Website Ordners:
</p>
<pre class="code">
sudo nano /usr/share/caddy/walo-web/assets/secrets/credentials.ini
</pre>
<p>Folgender Inhalt muss in dieser Datei sein:</p>
<pre class="code">
[mysql]
servername = "MYSQL_SERVER_ADDRESS"
username = "YOUR_USERNAME"
password = "YOUR_PASSWORD"
dbname = "walo"
</pre>
<p>
Ersetze <span class="code-inline">MYSQL_SERVER_ADDRESS</span> mit deiner Server-Addresse oder Domain, die du vorher registriert hast.
<br>
Ersetze <span class="code-inline">YOUR_USERNAME</span> mit dem <b>Benutzernamen</b>, den du für die MySQL Datenbank verwendet hast.
<br>
Ersetze <span class="code-inline">YOUR_PASSWORD</span> mit dem <b>Passwort</b>, den du für die MySQL Datenbank verwendet hast.
<br>
<span class="code-inline">dbname</span> kann gleich bleiben.
</p>

<p>
Außerdem musst eine Datei in <span class="code-inline">assets/secrets/database_token.txt</span> erstellen, wo du ein Passwort eingibst, welches unauthorisierten Zugriff vermeiden soll. Mehr dazu bei <a href="?article=Konfiguration.php#leaderboardsstatistik">Leaderboards & Statistik</a>.
</p>

<p>
Die Website kann jetzt auch Änderungen an der Datenbank vornehmen und somit dem Walo-Plugin helfen Kills, Wins & Playcount zu speichern!
<br>
Gehe über zur <a href="?article=Konfiguration.php">Konfiguration</a>!
</p>