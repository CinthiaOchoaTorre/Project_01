<?php
/**
 * quiz.php — Taste Quiz (Core Build + Secondary Feature 1)
 * A form that collects the user's palate preferences.
 * Flow: $_POST → validate required fields → htmlspecialchars() → store in
 * $_SESSION['palate']. Shows a confirmation that echoes the sanitized data.
 */
session_start();
require __DIR__ . '/data/dishes.php';

$page_title = 'Taste Quiz — Global Food Discovery';

// Option lists (also reused to render checkboxes/radios).
$flavor_options  = ['sweet', 'sour', 'savory', 'spicy', 'umami', 'bitter'];
$spice_options   = ['none', 'mild', 'medium', 'hot'];
$texture_options = ['crunchy', 'chewy', 'creamy', 'slimy', 'crispy'];
$diet_options    = ['vegetarian', 'vegan', 'gluten-free', 'dairy-free', 'no restrictions'];

$errors    = [];
$submitted = false;

// --- Handle the form submission --------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submitted = true;

    // Raw inputs (arrays for checkbox groups, string for the radio).
    $flavor_notes   = isset($_POST['flavor_notes']) ? (array) $_POST['flavor_notes'] : [];
    $spice          = isset($_POST['spice']) ? trim($_POST['spice']) : '';
    $textures       = isset($_POST['textures']) ? (array) $_POST['textures'] : [];
    $restrictions   = isset($_POST['restrictions']) ? (array) $_POST['restrictions'] : [];
    $name           = isset($_POST['name']) ? trim($_POST['name']) : '';

    // Validate REQUIRED fields.
    if ($name === '') {
        $errors[] = 'Please tell us your name.';
    }
    if (empty($flavor_notes)) {
        $errors[] = 'Please pick at least one flavor you enjoy.';
    }
    if ($spice === '' || !in_array($spice, $spice_options, true)) {
        $errors[] = 'Please choose your spice tolerance.';
    }

    // If valid, sanitize with htmlspecialchars() and store in the session.
    if (empty($errors)) {
        $_SESSION['palate'] = [
            'name'         => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
            'flavor_notes' => array_map(fn($v) => htmlspecialchars($v, ENT_QUOTES, 'UTF-8'), $flavor_notes),
            'spice'        => htmlspecialchars($spice, ENT_QUOTES, 'UTF-8'),
            'textures'     => array_map(fn($v) => htmlspecialchars($v, ENT_QUOTES, 'UTF-8'), $textures),
            'restrictions' => array_map(fn($v) => htmlspecialchars($v, ENT_QUOTES, 'UTF-8'), $restrictions),
        ];
    }
}

include __DIR__ . '/includes/header.php';
?>

<main id="main-content">
    <div class="container">
        <h1>Let's Map Your Palate</h1>
        <p>Tell us what you love and we'll tailor recommendations on your profile.</p>

        <div class="steps" aria-hidden="true">
            <span class="step-chip step-chip--active">1. Flavors</span>
            <span class="step-chip">2. Spice tolerance</span>
            <span class="step-chip">3. Disliked textures</span>
            <span class="step-chip">4. Restrictions</span>
        </div>

        <?php if ($submitted && empty($errors)): ?>
            <!-- Confirmation: echoes the SANITIZED session data back -->
            <div class="confirmation" role="status">
                <h2>Thanks, <?php echo $_SESSION['palate']['name']; ?>! Your palate is saved.</h2>
                <dl class="summary-list">
                    <dt>Flavors you enjoy</dt>
                    <dd><?php echo implode(', ', $_SESSION['palate']['flavor_notes']); ?></dd>

                    <dt>Spice tolerance</dt>
                    <dd><?php echo $_SESSION['palate']['spice']; ?></dd>

                    <dt>Disliked textures</dt>
                    <dd><?php echo !empty($_SESSION['palate']['textures']) ? implode(', ', $_SESSION['palate']['textures']) : 'none'; ?></dd>

                    <dt>Dietary restrictions</dt>
                    <dd><?php echo !empty($_SESSION['palate']['restrictions']) ? implode(', ', $_SESSION['palate']['restrictions']) : 'none'; ?></dd>
                </dl>
                <p style="margin-top:1rem;">
                    <a class="btn btn--accent" href="profile.php">See my recommendations</a>
                </p>
            </div>
        <?php endif; ?>

        <?php if ($submitted && !empty($errors)): ?>
            <div class="form-error" role="alert">
                <strong>Please fix the following:</strong>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form class="form-card" action="quiz.php" method="post" novalidate>
            <div class="field">
                <label class="field__label" for="name">
                    Your name <span class="required-star" aria-hidden="true">*</span>
                    <span class="field__hint">(required)</span>
                </label>
                <input
                    class="field__control"
                    type="text"
                    id="name"
                    name="name"
                    value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>"
                    required
                >
            </div>

            <fieldset class="field" style="border:none; padding:0; margin:0 0 1.5rem;">
                <legend class="field__label">
                    Flavors you enjoy <span class="required-star" aria-hidden="true">*</span>
                    <span class="field__hint">(pick at least one)</span>
                </legend>
                <div class="choice-group">
                    <?php foreach ($flavor_options as $flavor): ?>
                        <label class="choice">
                            <input
                                type="checkbox"
                                name="flavor_notes[]"
                                value="<?php echo $flavor; ?>"
                                <?php echo (isset($_POST['flavor_notes']) && in_array($flavor, (array) $_POST['flavor_notes'], true)) ? 'checked' : ''; ?>
                            >
                            <?php echo ucfirst($flavor); ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </fieldset>

            <fieldset class="field" style="border:none; padding:0; margin:0 0 1.5rem;">
                <legend class="field__label">
                    Spice tolerance <span class="required-star" aria-hidden="true">*</span>
                    <span class="field__hint">(required)</span>
                </legend>
                <div class="choice-group">
                    <?php foreach ($spice_options as $level): ?>
                        <label class="choice">
                            <input
                                type="radio"
                                name="spice"
                                value="<?php echo $level; ?>"
                                <?php echo (isset($_POST['spice']) && $_POST['spice'] === $level) ? 'checked' : ''; ?>
                            >
                            <?php echo ucfirst($level); ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </fieldset>

            <fieldset class="field" style="border:none; padding:0; margin:0 0 1.5rem;">
                <legend class="field__label">
                    Textures you dislike <span class="field__hint">(optional)</span>
                </legend>
                <div class="choice-group">
                    <?php foreach ($texture_options as $texture): ?>
                        <label class="choice">
                            <input
                                type="checkbox"
                                name="textures[]"
                                value="<?php echo $texture; ?>"
                                <?php echo (isset($_POST['textures']) && in_array($texture, (array) $_POST['textures'], true)) ? 'checked' : ''; ?>
                            >
                            <?php echo ucfirst($texture); ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </fieldset>

            <fieldset class="field" style="border:none; padding:0; margin:0 0 1.5rem;">
                <legend class="field__label">
                    Dietary restrictions <span class="field__hint">(optional)</span>
                </legend>
                <div class="choice-group">
                    <?php foreach ($diet_options as $diet): ?>
                        <label class="choice">
                            <input
                                type="checkbox"
                                name="restrictions[]"
                                value="<?php echo $diet; ?>"
                                <?php echo (isset($_POST['restrictions']) && in_array($diet, (array) $_POST['restrictions'], true)) ? 'checked' : ''; ?>
                            >
                            <?php echo ucfirst($diet); ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </fieldset>

            <button class="btn" type="submit">Save my palate</button>
        </form>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
