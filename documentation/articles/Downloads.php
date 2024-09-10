<h1>Downloads</h1>
<p>Hier findest du alle Downloads zu den Dateien, die zu Walo dazugehören!</p>

<?= Heading::generate('h2', 'Minecraft Server Paket'); ?>
<p>Alle folgenden Minecraft Plugins sind hier drinnen.</p>

<?=
(new DownloadsTable())
    ->addEntry('/downloads/self-hosting/walo-server-package.zip')
    ->render();
?>

<?= Heading::generate('h2', 'Minecraft Server'); ?>
<p>All diese Dateien können in Kombination eines Minecraft-Servers verwendet werden.</p>

<?= Heading::generate('h3', 'Minecraft Walo Plugin'); ?>
<p>Dieses Plugin ist für einen Spigot/Paper Minecraft Server der Version 1.8.*</p>

<?=
(new DownloadsTable())
    ->addEntriesFromFolder('/downloads/walo-plugin', 'jar')
    ->render();
?>

<p>Source Code: <a href="https://github.com/L0wLauch11/Walo">https://github.com/L0wLauch11/Walo</a></p>

<?= Heading::generate('h3', 'Walo Restart Companion'); ?>
<p>Startet den Minecraft Server automatisch neu, wenn das Spiel zuende ist.</p>

<?=
(new DownloadsTable())
    ->addEntry('/downloads/self-hosting/WaloRestartCompanion.jar')
    ->render();
?>

<p>Source Code: <a href="https://github.com/L0wLauch11/WaloRestartCompanion">https://github.com/L0wLauch11/WaloRestartCompanion</a></p>

<?= Heading::generate('h3', 'DamageIndicator-Disabler'); ?>
<p>Dieses Minecraft Plugin deaktiviert LabyMods DamageIndicator. Für Spigot/Paper 1.8.*</p>

<?=
(new DownloadsTable())
    ->addEntry('/downloads/self-hosting/callable_di_disabler-1.0.jar')
    ->render();
?>
<p>Source Code: <a href="https://github.com/L0wLauch11/callable_di_disabler">https://github.com/L0wLauch11/callable_di_disabler</a></p>

<?= Heading::generate('h2', 'Website'); ?>
<p>Die Website wird vom Source Code heruntergeladen: <a href="https://github.com/L0wLauch11/Walo-Web">https://github.com/L0wLauch11/Walo-Web</a></p>