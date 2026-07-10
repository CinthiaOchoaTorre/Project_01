<?php
/**
 * profile.php — My Profile (Secondary build)
 * Reads $_SESSION['palate'] (set by quiz.php), shows the saved preferences,
 * and recommends dishes from $dishes[] whose flavor tags match the user's
 * favorite flavors — while respecting their dietary restrictions.
 */
session_start();
require __DIR__ . '/data/dishes.php';

$page_title = 'My Profile — Global Food Discovery';

$palate = $_SESSION['palate'] ?? null;

// --- Build recommendations only if the quiz has been taken ------------------
$recommended = [];
if ($palate !== null) {
    $liked_flavors = $palate['flavor_notes'] ?? [];
    $restrictions  = $palate['restrictions'] ?? [];

    foreach ($dishes as $dish) {

        // Respect dietary restrictions (skip dishes that clash).
        $blocked = false;
        foreach ($restrictions as $r) {
            if ($r === 'vegetarian' && (in_array('contains-pork', $dish['dietary_flags'], true) || !array_intersect(['vegetarian', 'vegan'], $dish['dietary_flags']))) {
                // must be explicitly vegetarian/vegan to pass
                if (!array_intersect(['vegetarian', 'vegan'], $dish['dietary_flags'])) {
                    $blocked = true;
                }
            }
            if ($r === 'vegan' && !in_array('vegan', $dish['dietary_flags'], true)) {
                $blocked = true;
            }
            if ($r === 'gluten-free' && !in_array('gluten-free', $dish['dietary_flags'], true)) {
                $blocked = true;
            }
            if ($r === 'dairy-free' && in_array('dairy', $dish['allergens'], true)) {
                $blocked = true;
            }
        }
        if ($blocked) {
            continue;
        }

        // Score by how many liked flavors this dish shares.
        $score = count(array_intersect($liked_flavors, $dish['flavor_tags']));
        if ($score > 0) {
            $dish['_score'] = $score;
            $recommended[]  = $dish;
        }
    }

    // Sort by best match, keep the top 3.
    usort($recommended, fn($a, $b) => $b['_score'] <=> $a['_score']);
    $recommended = array_slice($recommended, 0, 3);
}

include __DIR__ . '/includes/header.php';
?>

<main id="main-content">
    <div class="container">
        <?php if ($palate === null): ?>
            <h1>My Profile</h1>
            <!-- No quiz taken yet -->
            <div class="empty-state">
                <h2>You haven't taken the taste quiz yet</h2>
                <p>Take the quiz so we can recommend dishes just for you.</p>
                <a class="btn btn--accent" href="quiz.php">Take the Taste Quiz</a>
            </div>
        <?php else: ?>

            <!-- Dashboard header -->
            <div class="dashboard-head">
                <div class="dashboard-head__avatar" aria-hidden="true">&#9733;</div>
                <div>
                    <p class="dashboard-head__eyebrow">Palate Dashboard</p>
                    <h1><?php echo $palate['name']; ?>'s Profile</h1>
                </div>
            </div>

            <div class="profile-grid">
                <!-- Saved preferences (already sanitized in the session) -->
                <section class="panel" aria-label="Saved preferences">
                    <h2>Active Palate Preferences</h2>
                    <dl class="summary-list">
                        <dt>Flavors you enjoy</dt>
                        <dd>
                            <?php foreach ($palate['flavor_notes'] as $f): ?>
                                <span class="tag tag--flavor"><?php echo $f; ?></span>
                            <?php endforeach; ?>
                        </dd>

                        <dt>Spice tolerance</dt>
                        <dd><span class="tag"><?php echo $palate['spice']; ?></span></dd>

                        <dt>Disliked textures</dt>
                        <dd>
                            <?php if (!empty($palate['textures'])): ?>
                                <?php foreach ($palate['textures'] as $t): ?>
                                    <span class="tag"><?php echo $t; ?></span>
                                <?php endforeach; ?>
                            <?php else: ?>
                                none
                            <?php endif; ?>
                        </dd>

                        <dt>Dietary restrictions</dt>
                        <dd>
                            <?php if (!empty($palate['restrictions'])): ?>
                                <?php foreach ($palate['restrictions'] as $r): ?>
                                    <span class="tag tag--diet"><?php echo $r; ?></span>
                                <?php endforeach; ?>
                            <?php else: ?>
                                none
                            <?php endif; ?>
                        </dd>
                    </dl>
                    <p style="margin-top:1rem;">
                        <a class="btn btn--ghost" href="quiz.php">Retake quiz</a>
                    </p>
                </section>

                <!-- Recommendations -->
                <section aria-label="Recommended dishes">
                    <h2>Recommended for You</h2>
                    <?php if (empty($recommended)): ?>
                        <div class="no-results">
                            <p>No dishes matched your flavors and restrictions yet.
                            Try <a href="explore.php">exploring all dishes</a>.</p>
                        </div>
                    <?php else: ?>
                        <div class="dish-grid" style="--grid-cols:1;">
                            <?php foreach ($recommended as $dish): ?>
                                <article class="dish-card">
                                    <img
                                        class="dish-card__media"
                                        src="<?php echo htmlspecialchars($dish['image']); ?>"
                                        alt="A serving of <?php echo htmlspecialchars($dish['name']); ?> from <?php echo htmlspecialchars($dish['country']); ?>"
                                        loading="lazy"
                                    >
                                    <div class="dish-card__body">
                                        <p class="dish-card__country"><?php echo htmlspecialchars($dish['country']); ?></p>
                                        <h3 class="dish-card__name"><?php echo htmlspecialchars($dish['name']); ?></h3>
                                        <div class="dish-card__tags">
                                            <?php foreach ($dish['flavor_tags'] as $t): ?>
                                                <span class="tag tag--flavor"><?php echo htmlspecialchars($t); ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                        <a class="btn btn--ghost dish-card__link" href="detail.php?id=<?php echo (int) $dish['id']; ?>">
                                            View dish
                                        </a>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </section>
            </div>

        <?php endif; ?>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
