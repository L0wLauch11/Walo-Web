<h1>Spielablauf</h1>
<p>Hier erfährst du im Detail, wie das Spiel abläuft / vom Plugin beeinflusst wird.</p>

<?= Heading::generate('h2', 'Lobbyphase'); ?>
<p>Bei Server Start können die Spieler beitreten und sind in einer Border eingegrenzt, bis das Spiel startet:</p>
<img class="screenshot" src="/assets/game-procedure/border.png" alt="">
<p>Dabei wird auf die nötige Spieleranzahl gewartet, bis das Spiel automatisch startet (anpassbar, siehe <a href="?article=Konfiguration.php#walokonfiguration">Konfiguration &rightarrow; <span class="code-inline">autostart.required-players</span></a>). </p>

<p>Bevor das geschieht können die Spieler aber ihre Teams erstellen:</p>
<img class="screenshot" src="/assets/game-procedure/teams-book.png" alt="">

<?= Heading::generate('h2', 'Hauptspielphase'); ?>
<p>Diese Phase dauert, je nach Einstellungen, um die 3 Stunden. Um die Spieldauer zu verkürzen können Borderzeiten und Größen angepasst werden, bzw. Schutzzeit an und ausgestellt werden.</p>
<p>Die Spieler sammeln gutes Equipment und versuchen sich gegenseitig umzubringen, bis nurnoch einer steht. Kills & Spielanzahl werden aufgezeichnet, sowie auch Wins. Diese kann man <a href="?article=Self-Hosting.php#mysqldatenbankfrleaderboards">auf der Website</a> einsehen.</p>

<?= Heading::generate('h3', 'Combat-Logging & Inaktivität'); ?>
<p>Wenn ein Spieler sich mitten im Combat ausloggt, bzw. unter eine gewisse Lebensanzahl fällt und sich dann ausloggt, wird er gebannt. Nach zu langer Inaktivität wird es dem Spieler auch verboten, wieder auf den Server zu joinen, was ihn effektiv ausscheidet.</p>

<?= Heading::generate('h3', 'Nether'); ?>
<p>Um ein faires Spielerlebnis darzustellen, wurden etwaige Nether-Fallen verhindert. Lava wird beim betreten des Nethers in einem Kreis um den Spieler entfernt, eine Bedrock schicht wird unter dem Spieler platziert, Betten werden abgebaut, etc. </p>

<?= Heading::generate('h2', 'Spielende'); ?>
<p>Sollte nurnoch 1 Team / 1 Spieler am Leben sein, wird das Spielende eingeleitet. Dabei wird der Sieger im Discord (angenommen, der <a href="?article=Konfiguration.php#discordwebhook">WebHook</a> ist eingerichtet) bekannt gegeben und der Server startet automatisch neu! Nach dem Neustart öffnet sich der Server wieder und es ist eine neue Welt bereit, wo man noch eine Runde spielen könnte.</p>