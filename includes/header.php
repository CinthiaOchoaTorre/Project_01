<?php
/**
 * includes/header.php
 * Opens the HTML document and loads the shared stylesheet.
 * Expects an optional $page_title variable set before include().
 */
$page_title = $page_title ?? 'Global Food Discovery';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Global Food Discovery — a culinary science magazine exploring dishes, flavors, and ingredients from around the world.">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <a class="skip-link" href="#main-content">Skip to main content</a>
    <header class="site-header">
        <div class="site-header__inner">
            <a class="site-header__brand" href="index.php">
                <span class="site-header__logo" aria-hidden="true">&#127869;</span>
                <span class="site-header__title">Global Food Discovery</span>
            </a>
            <?php include __DIR__ . '/nav.php'; ?>
        </div>
    </header>
