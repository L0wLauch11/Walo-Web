<?php include_once "NavigationLink.class.php" ?>

<nav>
    <ul>
        <li class="widescreen-only">
            <h1>Walo</h1>
        </li>

        <?= NavigationLink::generate('/', 'Home', '/assets/icon-home.png'); ?>
        <?= NavigationLink::generate('/leaderboards.php', 'Leaderboards', '/assets/icon-leaderboards.png'); ?>
        <?= NavigationLink::generate('/plugin.php', 'MC-Plugin', '/assets/plugin-source.png'); ?>
        <?= NavigationLink::generate('/documentation', 'Dokumentation', '/assets/icon-documentation.png'); ?>
        <span class="donation-link">
            <?= NavigationLink::generate('https://ko-fi.com/lowlauch', 'Spenden', '/assets/icon-donate.png', 'target="_blank"'); ?>
        </span>
    </ul>
</nav>