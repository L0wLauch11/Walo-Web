<?php include_once "NavigationLink.class.php" ?>

<nav>
    <ul>
        <li class="widescreen-only">
            <h1>Walo</h1>
        </li>

        <?= NavigationLink::generate('/index.php', 'Home', '/assets/icon-home.png'); ?>
        <?= NavigationLink::generate('/leaderboards.php', 'Leaderboards', '/assets/icon-leaderboards.png'); ?>
        <?= NavigationLink::generate('/documentation/', 'Dokumentation', '/assets/icon-documentation.png'); ?>
        
        <?php /* Donation link is a bit different from the others */ ?>
        <li class="donation-link">
                <a href='https://ko-fi.com/lowlauch' target="_blank">
                    <img src="/assets/icon-donate.png" alt="">
                    <span class='widescreen-only'>Spenden</span>
                </a>
        </li>
    </ul>
</nav>