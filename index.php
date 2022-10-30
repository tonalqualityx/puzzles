<?php
spl_autoload_register(function ($class_name) {
    include __DIR__ . '/class/' . $class_name . '.php';
});

$clue = array(
    'It seemed that even though I had never walked this',
    'street before, I knew this bench intimately, like a long',
    'lost friend or the first meeting of a soul mate.',
    'I was young enough to fear what was in the shadows, but old enough to pretend',
    'like I didnt. So as I walked the street alone I held my chin high and wore a',
    'confident smirk. The night was beautiful but unassuming. The fallen leaves',
    'littered the wet pavement like confetti after a parade. The moon was high in the',
    'clear sky and the only sound was the echo of my heels on the empty street. It was',
    'just me and the unknown.',
);

$cypher = new Ottendorf( $clue, "Why is Raven like a Writing Desk", ['case-sensitive' => false]);

$cypher->map_document();
$cypher->create_cypher();
$cypher->print_cypher();

?>
<?php echo '<h1>puzzles.ind Is Live!'; ?>
