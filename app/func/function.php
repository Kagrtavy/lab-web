<?php
function getPublications(): array
{
    return [
        [
            'id' => 1,
            'title' => 'Our Breakfast Ritual',
            'category' => 'FOOD',
            'content' => "I cannot look at a big bowl of salad without thinking of my mother. Let's talk about vegan breakfasts! For a woman who loves breakfast, there are no where near enough breakfast recipes up...",
            'author' => 'Emma',
            'image' => 'salad.jpg',
            'created' => '2018-05-15 10:00:00',
        ],
        [
            'id' => 2,
            'title' => 'My Homemade Dress',
            'category' => 'LOOKS',
            'content' => "A-line short sleeves above the knee red elastane peplum detail wool-mix soft pink lining. Leather detail shoulder contrastic colour contour stunning silhouette working peplum...",
            'author' => 'Emma',
            'image' => 'girl.jpg',
            'created' => '2018-05-14 12:30:00',
        ],
        [
            'id' => 3,
            'title' => 'Minimalist Travel: A Weekend in Venice',
            'category' => 'TRAVEL',
            'content' => "Venice is a city in northeastern Italy sited on a group of 118 small islands separated by canals and linked by bridges. It is located in the marshy Venetian Lagoon...",
            'author' => 'Emma',
            'image' => 'venice.jpg',
            'created' => '2018-05-10 09:00:00',
        ]
    ];
}

function getPublicationById(int $id): ?array
{
    $publications = getPublications();
    foreach ($publications as $publication) {
        if ($publication['id'] === $id) {
            return $publication;
        }
    }
    return null;
}