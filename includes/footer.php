    <!-- Newsletter sign-up (appears on every page, per the wireframe) -->
    <section class="newsletter" aria-labelledby="newsletter-heading">
        <div class="newsletter__inner">
            <h2 id="newsletter-heading">Never Miss a Dish</h2>
            <p>Be the first to hear about new menus and food trends from around the world.</p>
            <form class="newsletter__form" action="index.php" method="get" role="form">
                <label class="visually-hidden" for="newsletter-email">Email address</label>
                <input
                    class="newsletter__input"
                    type="email"
                    id="newsletter-email"
                    name="newsletter"
                    placeholder="you@example.com"
                >
                <button class="btn" type="submit">Subscribe</button>
            </form>
        </div>
    </section>

    <footer class="site-footer">
        <div class="site-footer__inner">
            <div>
                <p class="site-footer__text">
                    &copy; <?php echo date('Y'); ?> Global Food Discovery
                </p>
                <p class="site-footer__meta">
                    A Culinary Science &amp; Food Discovery Magazine &mdash;
                    built with PHP &amp; CSS by MaKayla Davis &amp; Cinthia Ochoa Torre.
                </p>
            </div>
            <ul class="site-footer__links">
                <li><a href="index.php">Home</a></li>
                <li><a href="explore.php">Explore</a></li>
                <li><a href="quiz.php">Taste Quiz</a></li>
                <li><a href="profile.php">My Profile</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>
