<?php
/**
 * explore.php — Explore / Multi-filter Search
 * PHP search with several $_GET filters (matches the wireframe sidebar):
 *   $_GET['q']       → keyword match on name/country/description/ingredients (stripos)
 *   $_GET['flavor']  → keep dishes with this flavor tag
 *   $_GET['avoid']   → hide dishes that contain this allergen
 *   $_GET['diet']    → keep dishes with this dietary flag
 * Results render as a CSS Grid gallery of dish cards.
 */
require __DIR__ . '/data/dishes.php';

$page_title = 'Explore Dishes — Global Food Discovery';

// --- Read + trim the search inputs -----------------------------------------
$q      = isset($_GET['q'])      ? trim($_GET['q'])      : '';
$flavor = isset($_GET['flavor']) ? trim($_GET['flavor']) : '';
$avoid  = isset($_GET['avoid'])  ? trim($_GET['avoid'])  : '';
$diet   = isset($_GET['diet'])   ? trim($_GET['diet'])   : '';

// Build the dropdown options from the data itself.
$flavor_options   = collect_tags($dishes, 'flavor_tags');
$allergen_options = collect_tags($dishes, 'allergens');
$diet_options     = collect_tags($dishes, 'dietary_flags');

// --- Filter the dishes ------------------------------------------------------
$results = [];
foreach ($dishes as $dish) {

    // 1) Keyword match (case-insensitive via stripos across several fields).
    $matches_keyword = true;
    if ($q !== '') {
        $haystack = strtolower(
            $dish['name'] . ' ' . $dish['country'] . ' ' . $dish['description'] . ' ' .
            implode(' ', $dish['ingredients']) . ' ' . implode(' ', $dish['flavor_tags'])
        );
        $matches_keyword = stripos($haystack, strtolower($q)) !== false;
    }

    // 2) Flavor tag must be present.
    $matches_flavor = ($flavor === '') || in_array($flavor, $dish['flavor_tags'], true);

    // 3) Avoid-allergen: dish must NOT contain the chosen allergen.
    $matches_avoid = ($avoid === '') || !in_array($avoid, $dish['allergens'], true);

    // 4) Dietary flag must be present.
    $matches_diet = ($diet === '') || in_array($diet, $dish['dietary_flags'], true);

    if ($matches_keyword && $matches_flavor && $matches_avoid && $matches_diet) {
        $results[] = $dish;
    }
}

/** Small helper to render <option> lists with the current selection kept. */
function render_options(array $options, $selected) {
    foreach ($options as $option) {
        $label = ucfirst(str_replace('-', ' ', $option));
        $isSel = $selected === $option ? ' selected' : '';
        echo '<option value="' . htmlspecialchars($option) . '"' . $isSel . '>'
           . htmlspecialchars($label) . '</option>';
    }
}

include __DIR__ . '/includes/header.php';
?>

<main id="main-content">
    <div class="container">
        <h1>Explore</h1>
        <p>Search by keyword and narrow down with flavor, allergen, and dietary filters.</p>

        <div class="explore-layout">

            <!-- Sidebar: filters (GET form) -->
            <aside class="filters">
                <form action="explore.php" method="get" role="search">
                    <h2>Filters</h2>

                    <div class="filters__group">
                        <label class="filters__label" for="q">Search by name</label>
                        <input class="filters__control" type="search" id="q" name="q"
                               value="<?php echo htmlspecialchars($q); ?>" placeholder="ramen, tacos…">
                    </div>

                    <div class="filters__group">
                        <label class="filters__label" for="flavor">Flavor profile</label>
                        <select class="filters__control" id="flavor" name="flavor">
                            <option value="">Any flavor</option>
                            <?php render_options($flavor_options, $flavor); ?>
                        </select>
                    </div>

                    <div class="filters__group">
                        <label class="filters__label" for="avoid">Avoid allergen</label>
                        <select class="filters__control" id="avoid" name="avoid">
                            <option value="">None</option>
                            <?php render_options($allergen_options, $avoid); ?>
                        </select>
                    </div>

                    <div class="filters__group">
                        <label class="filters__label" for="diet">Dietary</label>
                        <select class="filters__control" id="diet" name="diet">
                            <option value="">Any diet</option>
                            <?php render_options($diet_options, $diet); ?>
                        </select>
                    </div>

                    <div class="filters__group">
                        <button class="btn" type="submit">Apply filters</button>
                    </div>
                    <a class="tag" href="explore.php">Clear all</a>
                </form>
            </aside>

            <!-- Results -->
            <section class="results" aria-label="Search results">
                <p class="results__meta">
                    <strong><?php echo count($results); ?></strong>
                    dish<?php echo count($results) === 1 ? '' : 'es'; ?> found
                    <?php if ($q !== ''): ?> for &ldquo;<strong><?php echo htmlspecialchars($q); ?></strong>&rdquo;<?php endif; ?>
                </p>

                <?php if (empty($results)): ?>
                    <div class="no-results">
                        <h2>No dishes matched your search.</h2>
                        <p>Try a different keyword or <a href="explore.php">clear the filters</a>.</p>
                    </div>
                <?php else: ?>
                    <div class="dish-grid">
                        <?php foreach ($results as $dish): ?>
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
                                        <?php foreach ($dish['dietary_flags'] as $t): ?>
                                            <span class="tag tag--diet"><?php echo htmlspecialchars(str_replace('-', ' ', $t)); ?></span>
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
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
