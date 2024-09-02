<h1>Server Konfiguration</h1>

<?= Heading::generate('h2', 'Walo Konfiguration'); ?>
<p>Du findest die Walo-Dokumentation im Server Ordner &rightarrow; plugins &rightarrow; Walo &rightarrow; <span class="code-inline">config.yml</span>. Die Standardkonfiguration sieht so aus:</p>
<pre class="code">
<?= htmlspecialchars(file_get_contents('https://raw.githubusercontent.com/L0wLauch11/Walo/main/src/main/resources/config.yml')); ?>
</pre>

<?= Heading::generate('h3', 'Discord Webhook'); ?>
<p>Falls du einen <a href="https://support.discord.com/hc/en-us/articles/228383668-Intro-to-Webhooks">Discord-Webhook</a> einrichten willst, um automatisch Siege auf einem Discord Server anzeigen zu lassen, kannst du hier die Webhook-URL einfügen:</p>
<pre class="code">
discord-webhook-url: &lt;your-discord-webhook-url&gt;
</pre>

<?= Heading::generate('h3', 'Leaderboards & Statistik'); ?>
<p>Falls du auf deiner eigenen Walo-Website Statistiken & Leaderboards anzeigen lassen willst gebe die URL des Webservers an, zum Beispiel könnte man folgende Konfiguration verwenden, um das Walo-Plugin mit dieser Website zu verbinden:</p>
<pre class="code">
web-database-api:
  url: https://walo.mine.bz/database.php
  access-token: &lt;Hier bräuchtest du den access token, der unter 'assets/secrets/database_token.txt' am Webserver gespeichert ist&gt;
</pre>

<?= Heading::generate('h3', 'Andere Optionen'); ?>
<p>Jede Konfigurationsoption ist mit einem Kommentar versehen, also kannst du sie dir durchlesen, falls du mehr anpassen willst (z. B. Border-Zeiten, Schutzzeit, ...).</p>

<?= Heading::generate('h2', 'Optionale Einstellungen'); ?>
<p>Die meisten dieser Optionen sind schon voreingerichtet, falls du das <a href="?article=Self-Hosting.php#dasvorgemachteserverpaketverwenden">Server-Paket</a> verwendet hast. Falls du den Server auf eigene Faust eingerichtet hast, solltest du aber alle dieser Einstellungen berücksichtigen.</p>

<?= Heading::generate('h3', 'server.properties'); ?>
<p>In der Datei server.properties kann die Spielerzahl angepasst werden:</p>
<pre class="code">
max-players=50
</pre>

<p>Noch dazu, sollten Achievements ausgeschalten werden, sodass man nicht sieht, wenn ein anderer Spieler z. B. Diamanten gefunden hat:</p>
<pre class="code">
announce-player-achievements=false
</pre>

<p>Spawn Protection sollte auf jeden Fall ausgeschalten werden:</p>
<pre class="code">
spawn-protection=0
</pre>

<?= Heading::generate('h3', 'spigot.yml'); ?>
<p>Anti-XRay kann viel Performance vom Server beanspruchen. Falls es dir Probleme macht, kannst du in <span class="code-inline">spigot.yml</span> den Engine-Mode umschalten, bzw. Anti-XRay ganz ausstellen:</p>
<pre class="code">
anti-xray:
  ...
  enabled: &lt;<b>true</b>/<b>false</b>&gt;
  engine-mode: <b>1 - 3</b>
  ...
</pre>

<?= Heading::generate('h3', 'bukkit.yml'); ?>
<p>Um TerrainControl die Kontrolle über die Walo-Welt zu geben (und somit Ozeane zu deaktivieren), musst du folgendes in <span class="code-inline">bukkit.yml</span> kopieren:</p>
<pre class="code">
worlds:
  world:
    generator: TerrainControl
</pre>

<?= Heading::generate('h3', 'TerrainControl'); ?>
<p>Suche nach der Option <span class="code-inline">LandRarity</span> im Server Ordner &rightarrow; <span class="code-inline">plugins/TerrainControl/worlds/world/WorldConfig.ini</span> und passe diesen auf <span class="code-inline">100</span> an (deaktiviert den Ozean):</p>
<pre class="code">
# Land rarity from 100 to 1. If you set smaller than 90 and LandSize near 0 beware Big oceans.
LandRarity: 100
</pre>

<p>TerrainControl kann noch viel mehr als Ozeane deaktivieren. Du kannst dich gerne ein bisschen mit den Konfigurationen dieses Plugins spielen.</p>