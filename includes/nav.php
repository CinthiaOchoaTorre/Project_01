<?php
/**
 * includes/nav.php
 * Primary site navigation with a PURE-CSS hamburger menu (no JavaScript).
 * The hidden checkbox toggles the menu on mobile via the :checked selector.
 * Current page is highlighted using the script filename.
 */
$current = basename($_SERVER['PHP_SELF']);

$links = [
    'index.php'   => 'Home',
    'explore.php' => 'Explore',
    'quiz.php'    => 'Taste Quiz',
    'profile.php' => 'My Profile',
];
?>
<input class="nav-toggle" type="checkbox" id="nav-toggle">
<label class="nav-toggle-btn" for="nav-toggle">
    <span aria-hidden="true">&#9776;</span>
    <span class="visually-hidden">Toggle navigation menu</span>
</label>
<nav class="site-nav" aria-label="Primary">
    <ul class="site-nav__list">
        <?php foreach ($links as $href => $label): ?>
            <li class="site-nav__item">
                <a
                    class="site-nav__link<?php echo $current === $href ? ' site-nav__link--active' : ''; ?>"
                    href="<?php echo $href; ?>"
                    <?php echo $current === $href ? 'aria-current="page"' : ''; ?>
                >
                    <?php echo $label; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
