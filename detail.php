<?php
/**
 * detail.php — Single dish detail
 * Pulls a dish by $_GET['id']. Validates the id exists; if not, redirects
 * back to explore.php (header() must run before any HTML output).
 * Renders flavor profile, ingredients, and an allergen warning block.
 * Includes a pure-CSS "similar dishes" carousel (Secondary Feature 2).
 */
require __DIR__ . '/data/dishes.php';

// --- Validate the id BEFORE any output so we can redirect if invalid -------
$id   = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$dish = get_dish_by_id($dishes, $id);

if ($dish === null) {
    header('Location: explore.php');
    exit;
}

// --- Build up to 3 "similar" dishes: same country OR a shared flavor tag ----
$similar = [];
foreach ($dishes as $candidate) {
    if ($candidate['id'] === $dish['id']) {
        continue;
    }
    $shares_flavor = array_intersect($candidate['flavor_tags'], $dish['flavor_tags']);
    if ($candidate['country'] === $dish['country'] || !empty($shares_flavor)) {
        $similar[] = $candidate;
    }
    if (count($similar) === 3) {
        break;
    }
}

$page_title = htmlspecialchars($dish['name']) . ' — Global Food Discovery';

include __DIR__ . '/includes/header.php';
?>

<main id="main-content">
    <div class="container">
        <a class="back-link" href="explore.php">&larr; Back to all dishes</a>

        <article class="detail">
            <img
                class="detail__media"
                src="<?php echo htmlspecialchars($dish['image']); ?>"
                alt="A serving of <?php echo htmlspecialchars($dish['name']); ?> from <?php echo htmlspecialchars($dish['country']); ?>"
            >

            <div class="detail__info">
                <p class="detail__country"><?php echo htmlspecialchars($dish['country']); ?></p>
                <h1><?php echo htmlspecialchars($dish['name']); ?></h1>
                <p><?php echo htmlspecialchars($dish['description']); ?></p>

                <div class="detail__section">
                    <h2>Flavor Profile</h2>
                    <div>
                        <?php foreach ($dish['flavor_tags'] as $tag): ?>
                            <span class="tag tag--flavor"><?php echo htmlspecialchars($tag); ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php if (!empty($dish['dietary_flags'])): ?>
                    <div class="detail__section">
                        <h2>Dietary</h2>
                        <div>
                            <?php foreach ($dish['dietary_flags'] as $flag): ?>
                                <span class="tag tag--diet"><?php echo htmlspecialchars(str_replace('-', ' ', $flag)); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </article>

        <div class="detail" style="margin-top: 2rem;">
            <div class="detail__section">
                <h2>Ingredients</h2>
                <ul class="ingredient-list">
                    <?php foreach ($dish['ingredients'] as $ingredient): ?>
                        <li><?php echo htmlspecialchars($ingredient); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Allergen warning block -->
            <?php if (!empty($dish['allergens'])): ?>
                <section class="allergen-warning" role="alert" aria-labelledby="allergen-heading">
                    <h2 id="allergen-heading"><span aria-hidden="true">&#9888;</span> Allergen Warning</h2>
                    <p>This dish contains the following common allergens:</p>
                    <div class="allergen-warning__list">
                        <?php foreach ($dish['allergens'] as $allergen): ?>
                            <span class="tag"><?php echo htmlspecialchars($allergen); ?></span>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php else: ?>
                <section class="allergen-warning allergen-warning--clear" aria-labelledby="allergen-heading">
                    <h2 id="allergen-heading"><span aria-hidden="true">&#10003;</span> No Listed Allergens</h2>
                    <p>This dish has no common allergens listed. Always confirm with your server.</p>
                </section>
            <?php endif; ?>
        </div>

        <!-- ================================================================
             Secondary Feature 2: pure-CSS carousel of similar dishes.
             Radio inputs + :checked selectors switch slides. Zero JavaScript.
             ================================================================ -->
        <?php if (!empty($similar)): ?>
            <section class="carousel" aria-label="Similar dishes carousel">
                <h2 class="carousel__heading">You Might Also Like</h2>

                <?php foreach ($similar as $i => $s): ?>
                    <input
                        class="carousel__radio"
                        type="radio"
                        name="carousel"
                        id="slide-<?php echo $i + 1; ?>"
                        <?php echo $i === 0 ? 'checked' : ''; ?>
                    >
                <?php endforeach; ?>

                <div class="carousel__viewport">
                    <div class="carousel__track">
                        <?php foreach ($similar as $s): ?>
                            <div class="carousel__slide">
                                <div class="carousel__card">
                                    <img
                                        src="<?php echo htmlspecialchars($s['image']); ?>"
                                        alt="A serving of <?php echo htmlspecialchars($s['name']); ?> from <?php echo htmlspecialchars($s['country']); ?>"
                                        loading="lazy"
                                    >
                                    <div>
                                        <p class="dish-card__country"><?php echo htmlspecialchars($s['country']); ?></p>
                                        <h3 class="dish-card__name"><?php echo htmlspecialchars($s['name']); ?></h3>
                                        <p><?php echo htmlspecialchars($s['description']); ?></p>
                                        <a class="btn btn--ghost" href="detail.php?id=<?php echo (int) $s['id']; ?>">View dish</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="carousel__dots">
                    <?php foreach ($similar as $i => $s): ?>
                        <label class="carousel__dot" for="slide-<?php echo $i + 1; ?>">
                            <span class="visually-hidden">Show <?php echo htmlspecialchars($s['name']); ?></span>
                            <?php echo $i + 1; ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
