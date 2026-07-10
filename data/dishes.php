<?php
/**
 * data/dishes.php
 * -----------------------------------------------------------------------------
 * The shared $dishes[] array — the backbone of the whole site.
 * Every page reads from this one source so all pages "talk" to each other.
 *
 * Each dish MUST have the same fields:
 *   id             (int)      unique id, used by detail.php?id=X
 *   name           (string)
 *   country        (string)
 *   flavor_tags    (array)    e.g. umami, spicy, sweet
 *   ingredients    (array)
 *   allergens      (array)    e.g. gluten, soy, egg
 *   dietary_flags  (array)    e.g. vegetarian, vegan, gluten-free
 *   description    (string)
 *   image          (string)   image URL
 * -----------------------------------------------------------------------------
 */

$dishes = [
    [
        'id'            => 1,
        'name'          => 'Tonkotsu Ramen',
        'country'       => 'Japan',
        'flavor_tags'   => ['umami', 'savory', 'rich'],
        'ingredients'   => ['pork bone broth', 'ramen noodles', 'chashu pork', 'soft-boiled egg', 'green onion', 'nori'],
        'allergens'     => ['gluten', 'egg', 'soy'],
        'dietary_flags' => ['contains-pork'],
        'description'   => 'A creamy, milky-white pork bone broth simmered for hours until rich and deeply umami. Served with springy noodles, melt-in-your-mouth chashu pork, a marinated soft-boiled egg, and fresh green onion.',
        'image'         => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?auto=format&fit=crop&w=800&q=70',
    ],
    [
        'id'            => 2,
        'name'          => 'Margherita Pizza',
        'country'       => 'Italy',
        'flavor_tags'   => ['savory', 'fresh', 'cheesy'],
        'ingredients'   => ['pizza dough', 'san marzano tomatoes', 'fresh mozzarella', 'basil', 'olive oil'],
        'allergens'     => ['gluten', 'dairy'],
        'dietary_flags' => ['vegetarian'],
        'description'   => 'The classic Neapolitan pizza named for Queen Margherita — a thin, blistered crust topped with bright tomato sauce, fresh mozzarella, fragrant basil, and a drizzle of olive oil. Simple ingredients, perfect balance.',
        'image'         => 'https://images.unsplash.com/photo-1604068549290-dea0e4a305ca?auto=format&fit=crop&w=800&q=70',
    ],
    [
        'id'            => 3,
        'name'          => 'Pad Thai',
        'country'       => 'Thailand',
        'flavor_tags'   => ['sweet', 'sour', 'savory', 'spicy'],
        'ingredients'   => ['rice noodles', 'tamarind', 'fish sauce', 'peanuts', 'bean sprouts', 'lime', 'egg'],
        'allergens'     => ['peanuts', 'egg', 'fish', 'soy'],
        'dietary_flags' => ['gluten-free'],
        'description'   => "Thailand's beloved stir-fried rice noodle dish, balancing sweet, sour, and salty from tamarind and fish sauce. Finished with crushed peanuts, crisp bean sprouts, and a squeeze of fresh lime.",
        'image'         => 'https://images.unsplash.com/photo-1559314809-0d155014e29e?auto=format&fit=crop&w=800&q=70',
    ],
    [
        'id'            => 4,
        'name'          => 'Tacos al Pastor',
        'country'       => 'Mexico',
        'flavor_tags'   => ['savory', 'spicy', 'sweet', 'smoky'],
        'ingredients'   => ['marinated pork', 'corn tortillas', 'pineapple', 'onion', 'cilantro', 'lime'],
        'allergens'     => [],
        'dietary_flags' => ['gluten-free', 'contains-pork', 'dairy-free'],
        'description'   => 'Spit-roasted pork marinated in dried chiles and achiote, shaved onto warm corn tortillas and topped with sweet grilled pineapple, raw onion, and cilantro. A street-food icon of Mexico City.',
        'image'         => 'https://images.unsplash.com/photo-1565299585323-38d6b0865b47?auto=format&fit=crop&w=800&q=70',
    ],
    [
        'id'            => 5,
        'name'          => 'Masala Dosa',
        'country'       => 'India',
        'flavor_tags'   => ['savory', 'tangy', 'spicy'],
        'ingredients'   => ['fermented rice batter', 'urad dal', 'potato', 'onion', 'mustard seeds', 'curry leaves'],
        'allergens'     => [],
        'dietary_flags' => ['vegetarian', 'vegan', 'gluten-free'],
        'description'   => 'A giant, crisp fermented rice-and-lentil crepe from South India, wrapped around a spiced potato filling. Served with coconut chutney and tangy sambar for dipping.',
        'image'         => 'https://images.unsplash.com/photo-1668236543090-82eba5ee5976?auto=format&fit=crop&w=800&q=70',
    ],
    [
        'id'            => 6,
        'name'          => 'Beef Bourguignon',
        'country'       => 'France',
        'flavor_tags'   => ['savory', 'rich', 'earthy'],
        'ingredients'   => ['beef chuck', 'red wine', 'bacon', 'carrots', 'pearl onions', 'mushrooms', 'thyme'],
        'allergens'     => [],
        'dietary_flags' => ['dairy-free'],
        'description'   => 'A rustic French stew of beef braised slowly in red wine with bacon, mushrooms, and pearl onions until fork-tender. Deeply savory and warming — comfort food from the Burgundy region.',
        'image'         => 'https://images.unsplash.com/photo-1600891964092-4316c288032e?auto=format&fit=crop&w=800&q=70',
    ],
    [
        'id'            => 7,
        'name'          => 'Falafel Plate',
        'country'       => 'Lebanon',
        'flavor_tags'   => ['savory', 'herby', 'nutty'],
        'ingredients'   => ['chickpeas', 'parsley', 'cumin', 'garlic', 'tahini', 'pita', 'tomato', 'cucumber'],
        'allergens'     => ['sesame', 'gluten'],
        'dietary_flags' => ['vegetarian', 'vegan'],
        'description'   => 'Crisp, herb-flecked chickpea fritters fried golden and served with creamy tahini sauce, warm pita, and a fresh chopped salad. A staple of Levantine cuisine.',
        'image'         => 'https://images.unsplash.com/photo-1593001874117-c99c800e3eb7?auto=format&fit=crop&w=800&q=70',
    ],
    [
        'id'            => 8,
        'name'          => 'Bibimbap',
        'country'       => 'South Korea',
        'flavor_tags'   => ['savory', 'spicy', 'fresh', 'umami'],
        'ingredients'   => ['steamed rice', 'gochujang', 'spinach', 'carrots', 'bean sprouts', 'beef', 'fried egg', 'sesame oil'],
        'allergens'     => ['egg', 'soy', 'sesame'],
        'dietary_flags' => ['gluten-free'],
        'description'   => 'A colorful Korean rice bowl topped with an array of seasoned vegetables, marinated beef, and a fried egg. Mixed together at the table with spicy-sweet gochujang and nutty sesame oil.',
        'image'         => 'https://images.unsplash.com/photo-1553163147-622ab57be1c7?auto=format&fit=crop&w=800&q=70',
    ],
];

/**
 * Helper: return a single dish by its id, or null if it does not exist.
 * Used by detail.php to validate the ?id= parameter.
 */
function get_dish_by_id(array $dishes, $id) {
    foreach ($dishes as $dish) {
        if ($dish['id'] === (int) $id) {
            return $dish;
        }
    }
    return null;
}

/**
 * Helper: collect every unique tag across all dishes for a given field
 * (flavor_tags, dietary_flags, ingredients, allergens). Powers the
 * filter dropdown on explore.php.
 */
function collect_tags(array $dishes, $field) {
    $tags = [];
    foreach ($dishes as $dish) {
        foreach ($dish[$field] as $tag) {
            $tags[$tag] = true;
        }
    }
    $tags = array_keys($tags);
    sort($tags);
    return $tags;
}
