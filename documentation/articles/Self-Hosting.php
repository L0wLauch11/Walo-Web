<h1>Self-Hosting</h1>
<p>
Hier erfährst du, wie du deinen eigenen Minecraft-Walo Server inklusive Website und Discord hosten kannst!
</p>

<h2 id="preparation">Vorbereitung</h2>
<p>
Folgende Dinge müssen auf der Host-Maschine installiert sein:
</p>

<ul>
    <li>Java Version 8, zum Beispiel <a href="https://www.azul.com/downloads/#downloads-table-zulu">Azul OpenJDK</a>. Auf den meisten Minecraft-Server Anbietern inklusive.</li>
</ul>

<h2>Das vorgemachte Server-Paket verwenden</h2>

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

<h3>Server starten</h3>
<p>
Nach dem Herunterladen muss man die .zip Datei nurnoch extrahieren, die <b>eula.txt</b> akzeptieren und <b>start.bat</b> (Windows) bzw. <b>start.sh</b> (Unix) ausführen. Am besten du hast einen VPS oder Bare-Metal Server anstelle eines Minecraft-Server anbieters. VPS Anbieter geben dir mehr Kontrolle über dein System, was für manche Features des Walo-Plugins erforderlich sind (Leaderboards, Website, automatischer Restart). 
</p>

<p>
Wie du den Walo-Server, bzw. das Plugin einrichten kannst erfährst du <a href="?article=Konfiguration.php">hier</a>!
</p>

<h2>Optionale Features einrichten</h2>
<p>
Für diesen Teil wirst du Systemzugriff auf deinen Server benötigen, was Minecraft-Server Anbieter in der Regel ausschließt. Ich empfehle einen günstigen <a href="https://en.wikipedia.org/wiki/Virtual_private_server">VPS</a> zu kaufen, wie einer von <a href="https://contabo.com/de/vps/">Contabo</a>. Alternativ kannst du den Server auch bei dir Zuhause beispielsweise auf einem alten Computer ausführen. Falls dies für dich keine Möglichkeit darstellt, kannst du aber trotzdem den Minecraft-Server verwenden, jedoch ohne Leaderboards und automatischen Restarts.
</p>

<h3>Website</h3>
<p>
Dieser Teil setzt voraus, dass du <a href="https://ubuntu.com/download/server">Ubuntu Server</a> 24.04 verwendest. Du kannst auch die Website auf dem selben VPS / Computer laufen lassen, auf dem auch der Minecraft-Server läuft.
</p>

<p>
Installiere <span class="code-inline">git</span>, <span class="code-inline">caddy</span>, <span class="code-inline">php-fpm</span> und <span class="code-inline">php-mysql</span> um die Website einrichten zu können:
</p>
<pre class="code">sudo apt install caddy php-fpm php-mysql</pre>

<p>
Dann klone folgende Git-Repository und verschiebe sie in <span class="code-inline">/usr/share/caddy/walo-web</span>:
</p>
<pre class="code">
git clone https://github.com/L0wLauch11/Walo-Web.git
sudo mv -f Walo-Web /usr/share/caddy/walo-web
sudo chgrp -R www-data /usr/share/caddy/walo-web/
</pre>
<p>
Beachte, dass du bei jedem Update der Website die Repository nochmal klonen müsstest (also nochmal diese zwei Befehle ausführen). Bei einer Aktualisierung der Website, ist auch wichtig, dass das Walo-Plugin auf der neusten Version ist, da sie sonst eventuell nicht mehr gut zusammen spielen können.
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

<h4>MySQL Datenbank für Leaderboards</h4>
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
Die Website kann jetzt auch Änderungen an der Datenbank vornehmen und somit dem Walo-Plugin helfen Kills, Wins & Playcount zu speichern!
</p>