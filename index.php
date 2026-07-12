<?php
/**
 * index.php — Home
 * Hero banner, unified search bar (posts to explore.php via GET),
 * and 4 featured dishes pulled from the shared $dishes[] array.
 */
require __DIR__ . '/data/dishes.php';

$page_title = 'Global Food Discovery — Home';

// Pick the first 4 dishes as "featured".
$featured = array_slice($dishes, 0, 4);

include __DIR__ . '/includes/header.php';
?>

<section class="hero">
    <div class="hero__inner">
        <h1>Taste the World, One Dish at a Time</h1>
        <p class="hero__subtitle">
            Explore iconic dishes from every corner of the globe — their flavors,
            ingredients, and the allergens you need to know about.
        </p>
        <form class="searchbar" action="explore.php" method="get" role="search">
            <label class="visually-hidden" for="hero-search">Search dishes</label>
            <input
                class="searchbar__input"
                type="search"
                id="hero-search"
                name="q"
                placeholder="Search dishes, e.g. ramen, tacos, vegan…"
            >
            <button class="btn" type="submit">Search</button>
        </form>
    </div>
</section>

<main id="main-content">
    <div class="container">
        <h2 class="section-title">Featured Dishes</h2>

        <div class="dish-grid">
            <?php foreach ($featured as $dish): ?>
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
                            <?php foreach ($dish['flavor_tags'] as $tag): ?>
                                <span class="tag tag--flavor"><?php echo htmlspecialchars($tag); ?></span>
                            <?php endforeach; ?>
                        </div>
                        <a class="btn btn--ghost dish-card__link" href="detail.php?id=<?php echo (int) $dish['id']; ?>">
                            View dish
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

        <p style="text-align:center; margin-top: 2rem;">
            <a class="btn btn--accent" href="explore.php">Explore all dishes</a>
        </p>

        <!-- "Make your First Move" — quiz call to action -->
        <section class="cta" aria-labelledby="cta-heading">
            <img
                class="cta__media"
                src="images/dishes.png"
                alt="An assortment of colorful dishes spread across a table"
                loading="lazy"
            >
            <div class="cta__body">
                <h2 id="cta-heading">Make Your First Move</h2>
                <p>Unsure where to start? Take our taste quiz and we'll point you toward
                dishes that match your flavors, spice tolerance, and dietary needs.</p>
                <a class="btn" href="quiz.php">Take the Taste Quiz</a>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="testimonials" aria-labelledby="testimonials-heading">
            <h2 id="testimonials-heading">Testimonials</h2>
            <p>People love this!</p>
            <div class="testimonial-grid">
                <?php
                $testimonials = [
                    ['quote' => 'I found my new favorite ramen spot thanks to this magazine!', 'name' => 'Alex Turner',  'stars' => 5],
                    ['quote' => 'The allergen warnings are a lifesaver for my family.',          'name' => 'Dolly Parton', 'stars' => 5],
                    ['quote' => 'The taste quiz nailed my preferences. So fun to explore!',       'name' => 'James Blake',  'stars' => 4],
                ];
                foreach ($testimonials as $t):
                ?>
                    <figure class="testimonial">
                        <div class="testimonial__stars" aria-label="<?php echo (int) $t['stars']; ?> out of 5 stars">
                            <?php echo str_repeat('&#9733;', $t['stars']) . str_repeat('&#9734;', 5 - $t['stars']); ?>
                        </div>
                        <blockquote class="testimonial__quote">&ldquo;<?php echo htmlspecialchars($t['quote']); ?>&rdquo;</blockquote>
                        <figcaption class="testimonial__name"><?php echo htmlspecialchars($t['name']); ?></figcaption>
                    </figure>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
